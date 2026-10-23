<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\WhatsappController;
use App\Http\Controllers\SitemapController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes — Aliman Pilar Production
|--------------------------------------------------------------------------
*/

/* ===== HALAMAN PUBLIK ===== */
Route::get('/', [HomeController::class, 'index'])->name('home');

// Katalog
Route::prefix('katalog')->name('catalog.')->group(function () {
    Route::get('/', [CatalogController::class, 'index'])->name('index');
    Route::get('/{product:slug}', [CatalogController::class, 'show'])->name('show');
});

// Portofolio
Route::prefix('portofolio')->name('portfolio.')->group(function () {
    Route::get('/', [PortfolioController::class, 'index'])->name('index');
    Route::get('/{portfolio:slug}', [PortfolioController::class, 'show'])->name('show');
});

// Blog
Route::prefix('blog')->name('blog.')->group(function () {
    Route::get('/', [BlogController::class, 'index'])->name('index');
    Route::get('/{blogPost:slug}', [BlogController::class, 'show'])->name('show');
});

// Pages
Route::get('/tentang-kami', [PageController::class, 'about'])->name('about');
Route::get('/cara-pemesanan', [PageController::class, 'howToOrder'])->name('how-to-order');
Route::get('/kebijakan-privasi', [PageController::class, 'privacyPolicy'])->name('privacy-policy');
Route::get('/syarat-layanan', [PageController::class, 'terms'])->name('terms');

// Kontak — rate limited
Route::prefix('kontak')->name('contact.')->middleware('throttle:contact')->group(function () {
    Route::get('/', [ContactController::class, 'index'])->name('index');
    Route::post('/', [ContactController::class, 'store'])->name('store');
});

// WhatsApp API
Route::prefix('api/whatsapp')->name('whatsapp.')->group(function () {
    Route::get('/numbers', [WhatsappController::class, 'numbers'])->name('numbers');
    Route::post('/redirect', [WhatsappController::class, 'redirect'])->name('redirect');
});

// Sitemap & Robots
Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');
Route::get('/robots.txt', function () {
    return response(
        "User-agent: *\nAllow: /\nSitemap: " . url('/sitemap.xml'),
        200,
        ['Content-Type' => 'text/plain']
    );
});

/* ===== ADMIN PANEL ===== */
require __DIR__ . '/admin.php';
