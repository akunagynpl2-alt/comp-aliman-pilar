<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Database\Seeders\BlogSeeder;
use Database\Seeders\CategorySeeder;
use Database\Seeders\ClientSeeder;
use Database\Seeders\PortfolioSeeder;
use Database\Seeders\ProductSeeder;
use Database\Seeders\ProductPhotoSeeder;
use Database\Seeders\SiteSettingSeeder;
use Database\Seeders\TestimonialSeeder;
use Database\Seeders\WhatsappSeeder;
use App\Models\BlogPost;
use App\Models\BlogCategory;
use App\Models\Portfolio;
use App\Models\Product;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Support\Facades\Artisan;

class PublicPagesTest extends TestCase
{
    use RefreshDatabase;

    public function test_public_pages_render_without_seed_content(): void
    {
        $this->withoutVite();

        foreach ([
            '/',
            '/katalog',
            '/portofolio',
            '/blog',
            '/tentang-kami',
            '/cara-pemesanan',
            '/kontak',
            '/kebijakan-privasi',
            '/syarat-layanan',
            '/robots.txt',
        ] as $path) {
            $this->get($path)->assertOk();
        }

        $this->get(route('home'))->assertSee('images/logo.jpeg');
    }

    public function test_contact_form_saves_a_valid_inquiry(): void
    {
        $this->withoutVite();

        $response = $this->post('/kontak', [
            'name' => 'Nadia Event',
            'phone' => '+6281234567890',
            'event_type' => 'Corporate event',
            'event_date' => now()->addDays(10)->toDateString(),
            'event_location' => 'Jakarta',
            'needs' => 'Membutuhkan tenda, sound system, dan dukungan teknis.',
        ]);

        $response->assertRedirect(route('contact.index'));
        $this->assertDatabaseHas('contact_messages', [
            'name' => 'Nadia Event',
            'event_location' => 'Jakarta',
        ]);
    }

    public function test_seeded_public_catalog_content_and_sitemap_render(): void
    {
        $this->withoutVite();
        User::factory()->create(['role' => 'superadmin']);
        $this->seed([
            SiteSettingSeeder::class,
            CategorySeeder::class,
            ProductSeeder::class,
            ProductPhotoSeeder::class,
            PortfolioSeeder::class,
            BlogSeeder::class,
            TestimonialSeeder::class,
            ClientSeeder::class,
        ]);

        $this->assertCount(
            2,
            Product::where('slug', 'ac-standing-5-pk')->firstOrFail()->getMedia('images')
        );
        $home = $this->get('/')->assertOk()->assertSee('[CONTOH] Nama klien 01');
        foreach ([
            'AC Standing 5 PK',
            'AC Portable 1.5 PK',
            'Genset 40–300 KVA',
            'Meja IBM dan Kursi Futura',
            'Misty Fan',
            'Tenda Konvensional',
        ] as $productName) {
            $home->assertSee($productName);
        }
        $home->assertDontSee('Line Array System 10.000 Watt')
            ->assertDontSee('Placeholder foto kategori');
        $catalog = $this->get(route('catalog.index'))->assertOk();
        foreach ([
            'AC Standing 5 PK',
            'AC Portable 1.5 PK',
            'Genset 40–300 KVA',
            'Meja IBM dan Kursi Futura',
            'Misty Fan',
            'Tenda Konvensional',
        ] as $productName) {
            $catalog->assertSee($productName);
        }
        $catalog->assertDontSee('Sound System Portable Meeting');
        $catalog->assertSee('/storage/', false);
        $this->get(route('home'))
            ->assertOk()
            ->assertSee('Peta lokasi Aliman Pilar Production')
            ->assertSee('Jalan Serut No.78 Pondok Ranggon, Cipayung Jakarta Timur');
        $this->get(route('catalog.show', Product::firstOrFail()))->assertOk();
        $this->get(route('portfolio.index'))->assertOk();
        $this->get(route('portfolio.show', Portfolio::firstOrFail()))->assertOk();
        $this->get(route('blog.show', BlogPost::published()->firstOrFail()))->assertOk();
        $this->get('/sitemap.xml')->assertOk()->assertHeader('Content-Type', 'application/xml');
    }

    public function test_blog_seeder_skips_posts_with_a_clear_warning_when_no_admin_exists(): void
    {
        Artisan::call('db:seed', ['--class' => BlogSeeder::class]);

        $this->assertSame(4, BlogCategory::count());
        $this->assertSame(0, BlogPost::count());
        $this->assertStringContainsString('Artikel contoh dilewati', Artisan::output());
    }

    public function test_contact_page_shows_the_configured_phone_address_and_map(): void
    {
        $this->withoutVite();
        $this->seed([SiteSettingSeeder::class, WhatsappSeeder::class]);

        $this->get(route('contact.index'))
            ->assertOk()
            ->assertSee('628119275730')
            ->assertSee('Jalan Serut No.78 Pondok Ranggon, Cipayung Jakarta Timur')
            ->assertSee('https://www.google.com/maps?q=')
            ->assertSee('Buka petunjuk arah di Google Maps');

        $this->assertDatabaseHas('whatsapp_numbers', [
            'number' => '628119275730',
            'is_active' => true,
        ]);
    }

    public function test_whatsapp_cta_links_directly_to_active_number_without_a_popup(): void
    {
        $this->withoutVite();
        $this->seed([SiteSettingSeeder::class, WhatsappSeeder::class]);

        $this->get(route('home'))
            ->assertOk()
            ->assertSee('https://wa.me/628119275730?text=', false)
            ->assertSee('<svg class="h-5 w-5 shrink-0"', false)
            ->assertDontSee('Pilih tim tujuan')
            ->assertDontSee('whatsapp-dialog-title');
    }
}
