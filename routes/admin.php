<?php

use App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->name('admin.')->group(function () {

    /* Auth */
    Route::get('/login',  [Admin\AuthController::class, 'showLogin'])->name('login')->middleware('guest');
    Route::post('/login', [Admin\AuthController::class, 'login'])->name('login.post')->middleware(['guest', 'throttle:admin-login']);
    Route::post('/logout', [Admin\AuthController::class, 'logout'])->name('logout')->middleware(['auth', 'admin']);

    /* Protected routes */
    Route::middleware(['auth', 'admin'])->group(function () {

        Route::get('/dashboard', [Admin\DashboardController::class, 'index'])->name('dashboard');

        // Kategori
        Route::resource('kategori', Admin\CategoryController::class)->except('show')->parameters(['kategori' => 'category']);

        // Produk
        Route::resource('produk', Admin\ProductController::class)->except('show')->parameters(['produk' => 'product']);
        Route::delete('/produk/{product}/media/{media}', [Admin\ProductController::class, 'deleteMedia'])->name('produk.media.delete');

        // Portofolio
        Route::resource('portofolio', Admin\PortfolioController::class)->except('show')->parameters(['portofolio' => 'portfolio']);
        Route::delete('/portofolio/{portfolio}/media/{media}', [Admin\PortfolioController::class, 'deleteMedia'])->name('portofolio.media.delete');

        // Blog
        Route::resource('blog', Admin\BlogPostController::class)->except('show');
        Route::resource('blog-kategori', Admin\BlogCategoryController::class)->except('show')->parameters(['blog-kategori' => 'blogCategory']);

        // Testimoni
        Route::resource('testimoni', Admin\TestimonialController::class)->except('show')->parameters(['testimoni' => 'testimonial']);

        // Klien / Mitra
        Route::resource('klien', Admin\ClientController::class)->except('show')->parameters(['klien' => 'client']);

        // Pesan Masuk
        Route::get('/pesan', [Admin\ContactMessageController::class, 'index'])->name('pesan.index');
        Route::get('/pesan/{message}', [Admin\ContactMessageController::class, 'show'])->name('pesan.show');
        Route::delete('/pesan/{message}', [Admin\ContactMessageController::class, 'destroy'])->name('pesan.destroy');

        // Pengaturan
        Route::get('/pengaturan', [Admin\SettingController::class, 'index'])->name('pengaturan.index');
        Route::post('/pengaturan', [Admin\SettingController::class, 'update'])->name('pengaturan.update');

        // WhatsApp
        Route::resource('whatsapp-nomor', Admin\WhatsappNumberController::class)->except('show')->parameters(['whatsapp-nomor' => 'whatsappNumber']);
        Route::resource('whatsapp-template', Admin\WhatsappTemplateController::class)->except('show')->parameters(['whatsapp-template' => 'whatsappTemplate']);

        // Profile
        Route::get('/profil', [Admin\ProfileController::class, 'edit'])->name('profil.edit');
        Route::put('/profil', [Admin\ProfileController::class, 'update'])->name('profil.update');
    });
});
