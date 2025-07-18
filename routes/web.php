<?php

use App\Http\Controllers\authenticateController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\HalamanBarangController;
use App\Http\Controllers\HalamanJasaController;
use App\Http\Controllers\JasaController;
use App\Http\Controllers\KategoriBarangController;
use App\Http\Controllers\KategoriJasaController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\ManajemenPesananController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\RiwayatPesananController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::controller(LandingPageController::class)->group(function(){
    Route::get('/','index')->name('landing.home');
});
Route::controller(HalamanBarangController::class)->group(function(){
    Route::get('/halaman-barang','index')->name('halaman.barang');
    Route::get('/halaman-barang/{id}/pesan','renderPesanBarang')->middleware(['auth'])->name('halaman.barang.pesan');
});
Route::controller(HalamanJasaController::class)->group(function(){
    Route::get('/halaman-jasa','index')->name('halaman.jasa');
    Route::get('/halaman-jasa/{id}/pesan', 'renderPesanJasa')->middleware(['auth'])->name('halaman.jasa.pesan');
});

Route::controller(KeranjangController::class)->middleware(['auth'])->group(function(){
    Route::get('/lihat-keranjang','index')->name('keranjang.lihat');
    Route::post('/masukan-keranjang','store')->name('keranjang.masukan');
});

Route::controller(OrderController::class)->middleware(['auth'])->group(function(){
    Route::get('/checkout/bayar','index')->name('checkout.bayar');
    Route::post('/checkout','store')->name('checkout.store');
    Route::post('/checkout-berhasil','berhasil')->name('checkout.berhasil');
});

Route::controller(RiwayatPesananController::class)->middleware(['auth'])->group(function(){
    Route::get('cek-pesanan','index')->name('pesanan.cek');
});


Route::get('/beranda', function () {
    return view('beranda',['title'=>'Beranda']);
})->middleware('auth')->name('beranda');

Route::controller(authenticateController::class)->group(function() {
    Route::get('/login','renderLogin')->middleware('guest')->name('login');
    Route::get('/register','renderRegister')->middleware('guest')->name('register');
    Route::get('/forgot-password','renderForgotPassword')->middleware('guest')->name('forgot');
    Route::post('/register','registerAksi')->middleware('guest')->name('register.aksi');
    Route::post('/login','loginAksi')->middleware('guest')->name('login.aksi');
    Route::post('/logout','logoutAksi')->middleware('auth')->name('logout.aksi');
});

Route::controller(ManajemenPesananController::class)->middleware(['auth','role:admin'])->group(function(){
    Route::get('manajamen-pesanan/barang/index', 'renderManajemenBarang')->name('manajemenPesanan.barang.index');
    Route::get('manajamen-pesanan/jasa/index', 'renderManajemenJasa')->name('manajemenPesanan.jasa.index');
    
    Route::post('manajemen-pesanan/barang/{id}/selesaikan', 'selesikanOrderBarang')->name('manajemenPesanan.barang.selesaikan');
});

Route::middleware(['auth','role:admin'])->group(function(){
    Route::controller(BarangController::class)->group(function(){
        Route::get('/barang','index')->name('barang.index');
        Route::post('/barang/tambah', 'store')->name('barang.tambah');
        Route::post('/barang/hapus', 'destroy')->name('barang.hapus');
    });
    Route::controller(KategoriBarangController::class)->group(function(){
        Route::post('/kategori-barang/tambah','store')->name('kategoriBarang.tambah');
        Route::post('/kategori-barang/update','update')->name('kategoriBarang.update');
        Route::post('/kategori-barang/hapus','destroy')->name('kategoriBarang.hapus');
    });
    Route::controller(JasaController::class)->group(function(){
        Route::get('jasa','index')->name('jasa.index');
        Route::post('jasa/tambah','store')->name('jasa.tambah');
        Route::post('jasa/edit','update')->name('jasa.edit');
        Route::post('jasa/hapus','destroy')->name('jasa.hapus');
    });
    Route::controller(KategoriJasaController::class)->group(function(){
        Route::post('kategori-jasa/tambah','store')->name('kategoriJasa.tambah');
        Route::post('kategori-jasa/update','update')->name('kategoriJasa.update');
        Route::post('kategori-jasa/hapus','destroy')->name('kategoriJasa.hapus');
    });

});
