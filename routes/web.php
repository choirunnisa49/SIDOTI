<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/scan', function () {
    return view('instascan');
});

Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('owner')->group(function () {
    Route::get('/pabrik','Owner\PabrikController@index')->name('owner.pabrik.index');
    Route::get('/pabrik/lokasi/{kode_pabrik}','Owner\PabrikController@show');
    Route::get('/pabrik/{kode_pabrik}/edit','Owner\PabrikController@edit');
    Route::post('/pabrik/ubah','Owner\PabrikController@update')->name('owner.pabrik.edit');
    Route::post('/pabrik/tambah','Owner\PabrikController@store')->name('owner.pabrik.buat');
    Route::get('/pabrik/hapus/{kode_pabrik}','Owner\PabrikController@delete')->name('owner.pabrik.hapus');

    Route::get('/produk','Owner\KategoriController@index')->name('owner.produk.index');
    Route::get('/produk/buat','Owner\KategoriController@create')->name('owner.produk.buat');
    Route::get('/produk/{kode_kategori}/edit','Owner\KategoriController@edit')->name('owner.produk.ubah');
    Route::post('/produk/buat/proses','Owner\KategoriController@store')->name('owner.produk.buat.post');
    Route::post('/produk/ubah','Owner\KategoriController@update')->name('owner.produk.ubah.post');
    Route::get('/produk/hapus/{kode_kategori}','Owner\KategoriController@delete')->name('owner.produk.hapus');
});

// Route::resource('owner/pabrik', 'Owner\PabrikController');

Route::prefix('produksi')->group(function () {
    Route::get('/produk','Produksi\ProductController@index')->name('produksi.produk.index');
    Route::post('/produk/buat','Produksi\ProductController@store')->name('produksi.produk.buat');
});

Route::prefix('sales')->group(function () {
    Route::get('/toko','Sales\TokoController@index')->name('sales.toko.index');
    Route::post('/toko/buat','Sales\TokoController@store')->name('sales.toko.buat');
    Route::get('/toko/{kode_toko}/edit','Sales\TokoController@edit')->name('sales.toko.edit');
    Route::post('/toko/ubah','Sales\TokoController@update')->name('sales.toko.ubah.proses');
    Route::get('/toko/lokasi/{kode_toko}','Sales\TokoController@show');

    Route::get('/box','Sales\BoxController@index')->name('sales.box.index');
    Route::get('/box/{kode_box}/edit','Sales\BoxController@edit')->name('sales.box.edit');
    Route::post('/box/ubah','Sales\BoxController@update')->name('sales.box.ubah.proses');
});

Route::prefix('google-map')->group(function () {
    Route::get('/{kode_pabrik}','GoogleMapController@index')->name('google.map.index');
    Route::post('/post','GoogleMapController@store')->name('google.map.store');
});

Route::get('provinsi','Owner\PabrikController@get_province')->name('province');
Route::get('/kota/{id}','Owner\PabrikController@get_city')->name('city');