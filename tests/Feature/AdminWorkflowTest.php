<?php

namespace Tests\Feature;

use App\Models\BlogPost;
use App\Models\Category;
use App\Models\Portfolio;
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
        $this->assertArrayNotHasKey('price', (new Product)->getFillable());
    }

    public function test_admin_can_edit_and_delete_slug_routed_resources_by_id(): void
    {
        $this->withoutVite();
        $admin = User::factory()->create(['role' => 'admin']);
        $category = Category::create([
            'name' => 'Audio',
            'slug' => 'audio',
            'is_active' => true,
        ]);
        $product = Product::create([
            'category_id' => $category->id,
            'name' => 'Speaker Portable',
            'slug' => 'speaker-portable',
            'description' => 'Produk untuk acara.',
        ]);
        $portfolio = Portfolio::create([
            'title' => 'Pameran Industri',
            'slug' => 'pameran-industri',
            'event_type' => 'Pameran',
            'location' => 'Jakarta',
            'event_date' => '2025-01-15',
            'description' => 'Dokumentasi acara.',
        ]);
        $post = BlogPost::create([
            'user_id' => $admin->id,
            'title' => 'Panduan Acara',
            'slug' => 'panduan-acara',
            'content' => 'Konten artikel.',
        ]);

        $this->actingAs($admin)
            ->get(route('admin.produk.edit', $product->getKey()))
            ->assertOk();
        $this->actingAs($admin)
            ->put(route('admin.produk.update', $product->getKey()), [
                'name' => 'Speaker Portable Baru',
                'slug' => 'speaker-portable',
                'category_id' => $category->id,
                'description' => 'Produk yang diperbarui.',
            ])
            ->assertRedirect(route('admin.produk.index'));
        $this->assertDatabaseHas('products', ['id' => $product->id, 'name' => 'Speaker Portable Baru']);
        $this->actingAs($admin)
            ->delete(route('admin.produk.destroy', $product->getKey()))
            ->assertRedirect(route('admin.produk.index'));
        $this->assertDatabaseMissing('products', ['id' => $product->id]);

        $this->actingAs($admin)
            ->get(route('admin.portofolio.edit', $portfolio->getKey()))
            ->assertOk();
        $this->actingAs($admin)
            ->put(route('admin.portofolio.update', $portfolio->getKey()), [
                'title' => 'Pameran Diperbarui',
                'event_type' => 'Pameran',
                'location' => 'Jakarta',
                'event_date' => '2025-01-15',
                'description' => 'Dokumentasi acara yang diperbarui.',
            ])
            ->assertRedirect(route('admin.portofolio.index'));
        $this->assertDatabaseHas('portfolios', ['id' => $portfolio->id, 'slug' => 'pameran-industri']);
        $this->actingAs($admin)
            ->delete(route('admin.portofolio.destroy', $portfolio->getKey()))
            ->assertRedirect(route('admin.portofolio.index'));
        $this->assertDatabaseMissing('portfolios', ['id' => $portfolio->id]);

        $this->actingAs($admin)
            ->get(route('admin.blog.edit', $post->getKey()))
            ->assertOk();
        $this->actingAs($admin)
            ->put(route('admin.blog.update', $post->getKey()), [
                'title' => 'Panduan Acara Terbaru',
                'content' => 'Konten artikel yang diperbarui.',
            ])
            ->assertRedirect(route('admin.blog.index'));
        $this->assertDatabaseHas('blog_posts', ['id' => $post->id, 'slug' => 'panduan-acara']);
        $this->actingAs($admin)
            ->delete(route('admin.blog.destroy', $post->getKey()))
            ->assertRedirect(route('admin.blog.index'));
        $this->assertDatabaseMissing('blog_posts', ['id' => $post->id]);
    }

    public function test_testimonial_admin_endpoint_is_available_and_protected(): void
    {
        $this->withoutVite();
        $admin = User::factory()->create(['role' => 'admin']);

        $this->get(route('admin.testimoni.index'))->assertRedirect(route('admin.login'));
        $this->actingAs($admin)->get(route('admin.testimoni.index'))->assertOk();
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
