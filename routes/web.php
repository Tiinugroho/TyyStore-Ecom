<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BKController;
use App\Http\Controllers\BMController;
use App\Http\Controllers\RBController;
use App\Http\Controllers\RJController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\MutasiController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\PemasokController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RestockController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CheckoutClientController;

Route::get('/', [WelcomeController::class, 'index'])->middleware('only_client_or_guest');

Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'authenticating']);
Route::get('register', [AuthController::class, 'register']);
Route::post('register', [AuthController::class, 'registerProcess']);

Route::middleware('auth')->group(function () {
    Route::get('logout', [AuthController::class, 'logout']);

    Route::middleware('only_admin')->group(function () {
        Route::get('/admin/dashboard', [DashboardController::class, 'index']);

        Route::get('/admin/BarangKeluar', [BKController::class, 'index']);
        Route::get('/admin/BarangMasuk', [BMController::class, 'index']);
        Route::get('/admin/ReturnBeli', [RBController::class, 'index']);
        Route::get('/admin/ReturnJual', [RJController::class, 'index']);

        Route::resource('/admin/kategori', KategoriController::class);

        Route::resource('/admin/barang', BarangController::class);
        Route::get('/admin/barang/export-csv', [BarangController::class, 'exportCsv'])->name('admin.barang.export.csv');
        Route::get('/admin/barang/search', [BarangController::class, 'search'])->name('admin.barang.search');
        Route::post('admin/barang/{id}', [BarangController::class, 'update'])->name('admin.barang.update');

        Route::resource('/admin/restock', 'App\Http\Controllers\RestockController');
        Route::get('/admin/restock', [RestockController::class, 'index'])->name('admin.restock.index'); // Tambahkan route ini
        Route::get('/admin/restock/{id}', [RestockController::class, 'show'])->name('admin.restock.show');
        Route::post('/admin/restock/{id}', [RestockController::class, 'store'])->name('admin.restock.store');
        Route::delete('/admin/restock/{id}', [RestockController::class, 'destroy'])->name('admin.restock.destroy');
        Route::get('admin/get-harga/{id}', [RestockController::class, 'getHarga']);
        Route::get('admin/get-barang/{id_vendor}', [RestockController::class, 'getBarangByVendor']);
        Route::get('admin/checkout/detail/{kode}', [CheckoutController::class, 'detailBarang'])->name('admin.restock.detail');


        Route::resource('/admin/slider', SliderController::class);
        Route::post('admin/slider/{id}', [SliderController::class, 'update'])->name('admin.slider.update');

        Route::resource('/admin/user', UserController::class);
        Route::post('admin/user/{id}', [UserController::class, 'update'])->name('admin.user.update');

        Route::resource('/admin/pesanan', PesananController::class);

        Route::resource('/admin/mutasi', MutasiController::class);
        Route::get('/api/barang/{no_bukti}', [MutasiController::class, 'getBarangByNoBukti']);

        Route::get('/admin/BarangMasuk', [BMController::class, 'index'])->name('admin.barangmasuk.index');
        Route::get('/admin/BarangMasuk/{kode}', [BMController::class, 'show'])->name('admin.barangmasuk.show');

        Route::resource('/admin/pemasok', PemasokController::class);

        Route::resource('/admin/checkout', CheckoutController::class);
        Route::post('admin/checkout/approve/{id}', [CheckoutController::class, 'approve'])->name('admin.checkout.approve');
        Route::post('/admin/checkout/return/{id}', [CheckoutController::class, 'returnOrder'])->name('admin.checkout.return');
        Route::post('/admin/checkout/cancel/{id}', [CheckoutController::class, 'cancelOrder'])->name('admin.checkout.cancel');
        Route::get('admin/checkout/detail/{kode}', [CheckoutController::class, 'detailBarang'])->name('admin.checkout.detail');
    });
});

Route::middleware('only_client_or_guest')->group(function () {
    Route::resource('/cart', CartController::class);
    Route::put('/cart', [CartController::class, 'update'])->name('cart.update')->middleware('auth');
    Route::delete('/cart/{id}', [CartController::class, 'destroy'])->name('cart.destroy')->middleware('auth');
    Route::resource('/product-detail', ProductController::class);
    Route::post('/product-detail', [ProductController::class, 'store'])->name('product-detail.store');
    Route::resource('/profile', 'App\Http\Controllers\ProfileController');
    Route::resource('/blog', 'App\Http\Controllers\BlogController');
    Route::resource('/about', 'App\Http\Controllers\AboutController');
    Route::resource('/product', 'App\Http\Controllers\ProductListController');
    Route::resource('/checkout', CheckoutClientController::class);
    Route::post('/checkout', [CartController::class, 'checkout'])->name('checkout');
    Route::get('/upload-bukti-transaksi', [CartController::class, 'showUploadBuktiTransaksiForm'])->name('upload_bukti_transaksi_form');
    Route::post('/upload-bukti-transaksi', [CartController::class, 'uploadBuktiTransaksi'])->name('upload_bukti_transaksi');
});
