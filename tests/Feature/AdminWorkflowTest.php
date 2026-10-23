<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Database\Seeders\CategorySeeder;
use Database\Seeders\ProductSeeder;
use Database\Seeders\SiteSettingSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class AdminWorkflowTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_login_is_available_and_management_routes_are_protected(): void
    {
        $this->withoutVite();

        $this->get('/admin/login')->assertOk();
        $this->get('/admin/dashboard')->assertRedirect(route('admin.login'));
        $this->get('/register')->assertNotFound();
    }

    public function test_admin_can_manage_categories_and_products_without_price_fields(): void
    {
        $this->withoutVite();

        $admin = User::factory()->create(['role' => 'admin']);
        $this->actingAs($admin)
            ->get(route('admin.kategori.index'))
            ->assertOk();

        $this->actingAs($admin)->post(route('admin.kategori.store'), [
            'name' => 'Tenda Contoh',
            'description' => 'Kategori contoh untuk kebutuhan event.',
            'is_active' => '1',
        ])->assertRedirect(route('admin.kategori.index'));

        $category = Category::query()->where('slug', 'tenda-contoh')->firstOrFail();
        $this->assertNotContains('price', Schema::getColumnListing('products'));

        $this->actingAs($admin)->post(route('admin.produk.store'), [
            'name' => 'Tenda Serbaguna Contoh',
            'category_id' => $category->id,
            'description' => 'Perlindungan praktis untuk kegiatan luar ruang.',
            'capacity' => 'Ukuran mengikuti area acara.',
            'is_active' => '1',
        ])->assertRedirect(route('admin.produk.index'));

        $this->assertDatabaseHas('products', ['slug' => 'tenda-serbaguna-contoh']);
        $this->assertArrayNotHasKey('price', (new Product())->getFillable());
    }

    public function test_initial_catalog_covers_every_category_with_multiple_examples(): void
    {
        $this->seed([CategorySeeder::class, ProductSeeder::class]);

        $categories = Category::withCount('activeProducts')->get();

        $this->assertCount(13, $categories);
        foreach ($categories as $category) {
            $this->assertGreaterThanOrEqual(2, $category->active_products_count, "Category {$category->slug} needs at least two sample products.");
        }
    }

    public function test_site_settings_validate_email_phone_and_https_urls(): void
    {
        $this->withoutVite();
        $this->seed(SiteSettingSeeder::class);
        $admin = User::factory()->create(['role' => 'admin']);

        $this->actingAs($admin)
            ->post(route('admin.pengaturan.update'), [
                'settings' => [
                    'email' => 'not-an-email',
                    'phone_main' => 'call-me',
                    'instagram' => 'javascript:alert(1)',
                ],
            ])
            ->assertSessionHasErrors([
                'settings.email',
                'settings.phone_main',
                'settings.instagram',
            ]);

        $this->assertDatabaseHas('site_settings', ['key' => 'email', 'value' => '']);
    }
}
