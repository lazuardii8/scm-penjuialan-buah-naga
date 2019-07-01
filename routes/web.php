<?php

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

Route::group(['middleware' => 'auth'], function(){
	Route::resource('produk', 'ProdukController', ['except' => ['show']]);
	Route::get('/produk/{id}/destroy', 'ProdukController@destroy');
	
	Route::resource('pekerja', 'PekerjaController');
	Route::get('/pekerja/{id}/destroy', 'PekerjaController@destroy');
	Route::get('/pembeli', 'PekerjaController@pembeli');

	Route::get('/setting/{id}', 'HomeController@setting');
	Route::put('/Setting-edit/{id}', 'HomeController@updateProfile');

	Route::resource('pesanan', 'PesananController');
	Route::post('/bayar-produk', 'PesananController@bayarProduk');
	Route::get('/transaksi-pembayaran', 'TransaksiController@pembayaranProduk');
	Route::post('/pembayaran/upload', 'TransaksiController@pembayaranUpload');
	Route::get('/transaksi-berhasil', 'TransaksiController@ucapanBerhasil');
	Route::get('/history', 'TransaksiController@historyPesanan');
	Route::get('/pembayaran-verifikasi', 'TransaksiController@getPembayaranverif');
	Route::post('/pembayaran/verifikasi/{id}', 'TransaksiController@updatePembayaran');
	Route::get('/pengiriman/pesanan', 'TransaksiController@pengirimanPesanan');
	Route::post('/pengiriman/pesanan-user', 'TransaksiController@pengirimanPekerja');
	Route::get('/pengiriman-pesanan-pekerja', 'TransaksiController@pengirimanDataPesanan');
	Route::post('/pengiriman/paket/pesanan-user', 'TransaksiController@updatePaketPengiriman');
	Route::get('/data-orders/{id}/destroy', 'PesananController@destroyOrders');

	
	Route::get('/peramalan', 'PeramalanController@index');
	Route::post('/penjadwalan/add', 'ProdukController@penjadawalanAdd');
	Route::get('/penjadwalan', 'ProdukController@penjadawalan');

	
	Route::get('/stok-bahan-baku', 'ProdukController@stokbahan');
	Route::post('/catat-bahan-baku', 'ProdukController@catatBahan');
	Route::post('/update-catat-bahan-baku/{id}', 'ProdukController@catatBahanUpdate');
	Route::get('/catat-bahan-baku/{id}/destroy', 'ProdukController@catatBahanDistroy');

	Route::post('/catatan-penggunaan', 'ProdukController@stokpenggunaanbahan');

	Route::get('/suplier-user', 'SuplierController@index');
	Route::post('/tambah-suplier', 'SuplierController@store');
	Route::get('/suplier/{id}/destroy', 'SuplierController@destroy');
	Route::get('/suplier-bahan', 'SuplierController@suplierBahan');
	Route::post('/tambah-bahan-invest', 'SuplierController@storeInvest');
	Route::put('/edit-bahan-invest/{id}', 'SuplierController@updateInvest');
	Route::get('/suplier-bahan/{id}/destroy', 'SuplierController@suplierBahanDestroy');

	Route::post('/investasi/supplier/{id}', 'SuplierController@InvestBahanSuplier');

	Route::get('/suplier-investasi', 'SuplierController@investasiSUplier');
	Route::get('/suplier-investasi/history', 'SuplierController@historrySUplier');
	Route::get('/suplier-investasi/validasi', 'SuplierController@validasiInvestSUplier');
	Route::put('/suplier-investasi/validasi/{id}', 'SuplierController@updateInvestSuplier');



	Route::resource('transaksi', 'TransaksiController');
	Route::resource('Setting', 'SettingController', ['except' => ['index','show']]);
	Route::resource('Transaction', 'TransactionController', ['except' => ['index','show']]);
	Route::resource('Order', 'OrderController', ['except' => ['index','show']]);
	Route::resource('Profile', 'ProfileController', ['except' => ['index','show']]);

	Route::put('/Data/keamanan/{id}', 'PekerjaController@update_keamanan');
	Route::put('/Data/keamanan/suplier/{id}', 'SuplierController@update_keamanan');
});


Route::get('/home', 'HomeController@index');
Route::get('/', 'HomeController@index');

Route::resource('produk', 'ProdukController', ['only' => ['show']]);

// hapus nantik

Auth::routes();

// Route::group(['middleware' => 'mimin'], function(){
// 	Route::get('/mimin', 'MiminController@dasboard');
// });


// Route::get('/notifications/{id}', 'HomeController@notifications');

// Route::resource('/Product', 'ProductController', ['only' => ['index','show']]);
// Route::resource('/Setting', 'SettingController', ['only' => ['index','show']]);
// Route::resource('/Transaction', 'TransactionController', ['only' => ['index','show']]);
// Route::resource('/Order', 'OrderController', ['only' => ['index','show']]);
// Route::resource('/Profile', 'ProfileController', ['only' => ['index','show']]);


