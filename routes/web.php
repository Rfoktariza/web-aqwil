<?php

use App\Http\Controllers\Admin\AboutUsController;
use App\Http\Controllers\Admin\FeaturedProductController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductImageController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\WebpageSettingController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\NewsCategoryController;



// Frontend Routes
Route::get('/', [FrontendController::class, 'index'])->name('home');
Route::get('/produk', [FrontendController::class, 'produk'])->name('produk');
Route::get('/produk/{slug}', [FrontendController::class, 'detailProduk'])->name('detail.produk');
Route::get('/tentang-kami', [FrontendController::class, 'tentangKami'])->name('tentang');
Route::get('/kontak-kami', [FrontendController::class, 'kontakKami'])->name('kontak');
Route::get('/kebijakan-privasi', [FrontendController::class, 'kebijakanPrivasi'])->name('privasi');

// 🔹 Tambahan untuk artikel & berita
Route::get('/berita', [FrontendController::class, 'berita'])->name('berita');
Route::get('/berita/{slug}', [FrontendController::class, 'detailBerita'])->name('detail.berita');


// Admin Routes
Route::prefix('admin')->as('admin.')->middleware(['auth'])->group(function () {
    Route::get('/', [DashboardController::class, 'index']);

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::delete('produk/{produk}/image/{image}', [ProductController::class, 'destroyImage'])->name('produk.image.destroy');
    Route::resource('produk', ProductController::class);

    Route::resource('kategori', CategoryController::class);
    Route::get('/webpage-setting', [WebpageSettingController::class, 'index'])->name('webpage.setting');
    Route::post('/webpage-setting', [WebpageSettingController::class, 'update'])->name('webpage.setting.update');

    Route::get('/about', [AboutUsController::class, 'index'])->name('about');
    Route::post('/about', [AboutUsController::class, 'update'])->name('about.update');

    Route::resource('news', NewsController::class);
    Route::post('news/upload-image', [NewsController::class, 'uploadImage'])
        ->name('news.upload-image');


    Route::get('/settings', [SettingController::class, 'index'])
        ->name('settings');
    Route::put('/settings', [SettingController::class, 'update'])->name('settings.update');


    Route::resource('testimoni', TestimonialController::class);

    Route::resource('featured-products', FeaturedProductController::class)
        ->except(['show', 'edit', 'update']);
    Route::post('/about/client/store', [AboutUsController::class, 'storeClient'])->name('about.client.store');
    Route::delete('/about/client/{client}', [AboutUsController::class, 'destroyClient'])->name('about.client.destroy');
    Route::resource('kategori-berita', NewsCategoryController::class);

});



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
