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

Route::get('/', 'LoginController@index');
Route::post('login', 'LoginController@login')->name('login');

Route::group(['prefix' => 'walikelas'], function() {
    // Route::middleware('page_denied:Dashboard')->group(function(){
    //     Route::get('/home', 'DashboardController@index')->name('Dashboard');
    // });
    Route::group(['prefix' => 'Dasboard'], function() {
        Route::get('/Dashboard', 'WalikelasDashboardController@index')->name('dashboard-walikelas');
    });

    Route::group(['prefix' => 'Peminjaman'], function() {
        Route::get('/peminjaman-buku-view', 'WalikelasPeminjamanController@index')->name('peminjaman-buku');
        Route::get('/peminjaman-buku-tambah', 'WalikelasPeminjamanController@add')->name('peminjaman-buku-tambah');
        Route::get('/peminjaman-buku-cari', 'WalikelasPeminjamanController@searchpeminjaman')->name('peminjaman-buku-cari');
        Route::post('/peminjaman-buku-insert', 'WalikelasPeminjamanController@create')->name('peminjaman-buku-insert');
        Route::delete('/peminjaman-buku-delete', 'WalikelasPeminjamanController@destroy')->name('peminjaman-buku-delete');
    });
    Route::group(['prefix' => 'Pengembalian'], function() {
        Route::get('/pengembalian-buku-view', 'WalikelasPengembalianController@index')->name('pengembalian-buku');
        Route::get('/pengembalian-buku-tambah', 'WalikelasPengembalianController@add')->name('pengembalian-buku-tambah');
        Route::get('/pengembalian-buku-cari', 'WalikelasPengembalianController@searchpeminjaman')->name('pengembalian-buku-cari');
        Route::get('/pengembalian-buku-cari-add', 'WalikelasPengembalianController@caripeminjaman')->name('pengembalian-buku-cari-add');
        Route::post('/pengembalian-buku-add', 'WalikelasPengembalianController@create')->name('pengembalian-buku-add');
        Route::delete('/pengembalian-buku-delete', 'WalikelasPengembalianController@destroy')->name('pengembalian-buku-delete');
    });
    Route::group(['prefix' => 'Buku-Hilang'], function() {
        Route::get('/buku-hilang-view', 'WalikelasBukuhilangController@index')->name('buku-hilang');
        Route::get('/buku-hilang-tambah', 'WalikelasBukuhilangController@add')->name('buku-hilang-tambah');
        Route::get('/buku-hilang-cari', 'WalikelasBukuhilangController@searchbukuhilang')->name('buku-hilang-cari');
        Route::get('/buku-hilang-cari-add', 'WalikelasBukuhilangController@caribukuhilang')->name('buku-hilang-cari-add');
        Route::post('/buku-hilang-add', 'WalikelasBukuhilangController@create')->name('buku-hilang-add');
        Route::delete('/buku-hilang-delete', 'WalikelasBukuhilangController@destroy')->name('buku-hilang-delete');
    });
});

Route::group(['prefix' => 'perpustakaan'], function() {
    // Route::middleware('page_denied:Dashboard')->group(function(){
    //     Route::get('/home', 'DashboardController@index')->name('Dashboard');
    // });
    Route::group(['prefix' => 'Dasboard'], function() {
        Route::get('/Dashboard', 'PerpusDashboardController@index')->name('dashboard-perpus');
    });

    Route::group(['prefix' => 'walikelas'], function() {
        Route::get('/walikelas-view', 'PerpusWalikelasController@index')->name('walikelas-view');
        Route::get('/walikelas-cari', 'PerpusWalikelasController@walikelassearch')->name('walikelas-cari');
        Route::get('/walikelas-tambah', 'PerpusWalikelasController@add')->name('walikelas-tambah');
        Route::post('/walikelas-insert', 'PerpusWalikelasController@create')->name('walikelas-insert');
        Route::post('/walikelas-update', 'PerpusWalikelasController@update')->name('walikelas-update');
        Route::delete('/walikelas-delete', 'PerpusWalikelasController@destroy')->name('walikelas-delete');
    });

    Route::group(['prefix' => 'siswa'], function() {
        Route::get('/siswa-view', 'PerpusSiswaController@index')->name('siswa-view');
        Route::get('/siswa-cari', 'PerpusSiswaController@siswasearch')->name('siswa-cari');
        Route::get('/siswa-tambah', 'PerpusSiswaController@add')->name('siswa-tambah');
        Route::post('/siswa-insert', 'PerpusSiswaController@create')->name('siswa-insert');
        Route::post('/siswa-update', 'PerpusSiswaController@update')->name('siswa-update');
        Route::delete('/siswa-delete', 'PerpusSiswaController@destroy')->name('siswa-delete');
    });

    Route::group(['prefix' => 'list_buku'], function() {
        Route::get('/list_buku-view', 'PerpusListBukuController@index')->name('list_buku-view');
        Route::get('/list_buku-cari', 'PerpusListBukuController@listbukusearch')->name('list_buku-cari');
        Route::get('/list_buku-tambah', 'PerpusListBukuController@add')->name('list_buku-tambah');
        Route::post('/list_buku-insert', 'PerpusListBukuController@create')->name('list_buku-insert');
        Route::post('/list_buku-update', 'PerpusListBukuController@update')->name('list_buku-update');
    });
});

Route::get('/logout', 'LoginController@logout')->name("logout");
