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

Route::get('/', function () {
    return view('welcome');
})->middleware('guest');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('penjualan/dompul', 'Penjualan\DompulController@index');
Route::get('penjualan/dompul-data', 'Penjualan\DompulController@data');

Route::get('list/users', 'UsersController@index');
Route::get('list/users-data', 'UsersController@data');

Route::resource('bank', 'BankController');
Route::get('bank-data', 'BankController@data');

Route::resource('produk', 'ProdukController');
Route::get('master-produk', 'ProdukController@data');

Route::resource('satuan', 'SatuanController');
Route::get('master-satuan', 'SatuanController@data');

Route::resource('customer', 'CustController');
Route::get('master-customer', 'CustController@data');

Route::resource('sales', 'SalesController');
Route::get('master-sales', 'SalesController@data');

Route::resource('gudang', 'GudangController');
Route::get('master-gudang', 'GudangController@data');

Route::resource('lokasi', 'LokasiController');
Route::get('master-lokasi', 'LokasiController@data');

Route::resource('pemborong', 'PemborongController');
Route::get('master-pemborong', 'PemborongController@data');

Route::resource('supervisor', 'SupervisorController');
Route::get('master-supervisor', 'SupervisorController@data');

Route::resource('permintaan', 'PermintaanPenjualanController');
Route::get('karoseri-permintaan', 'PermintaanPenjualanController@data');
Route::post('getData','PermintaanPenjualanController@getData');
Route::post('accept/{id}', 'PermintaanPenjualanController@accept')->name('accept');


Route::resource('spkc', 'SPKCController');
Route::get('karoseri-spkc', 'SPKCController@data');

Route::resource('print', 'PrintSPKCController');
Route::get('karoseri-print_spkc', 'PrintSPKCController@data');
Route::post('getDataPrint','PrintSPKCController@getData');
Route::get('printKu/{id}', 'PrintSPKCController@print');

Route::resource('printview', 'ViewPrintController');
Route::get('karoseri-viewprint_spkc', 'ViewPrintController@data');
Route::post('getDataView','ViewPrintController@getData');
Route::get('viewprint/{id}', 'ViewPrintController@print');

// penjualan
Route::post('/penjualan/dompul/verify/{canvaser}/{tgl}/{downline}','PenjualanDompulController@verify');
Route::get('/penjualan/dompul/list-invoice', 'ListPenjualanDompulController@index');
Route::get('/penjualan/dompul/list-invoice/edit/{id}/{canvaser}/{tgl}/{downline}', 'ListPenjualanDompulController@edit');
Route::get('/penjualan/dompul/invoice-dompul', 'PenjualanDompulController@index');
Route::post('/penjualan/dompul/invoice-dompul', 'PenjualanDompulController@show');
Route::get('/penjualan/dompul/{canvaser}/{tgl}/{downline}', 'PenjualanDompulController@edit');
Route::post('/invoice_dompul/store','PenjualanDompulController@store');
Route::post('/list_invoice_dompul/update','ListPenjualanDompulController@update');
Route::get('/invoice_dompul/list/{tgl_penjualan}', 'ListPenjualanDompulController@data');
Route::post('/invoice_dompul/update/{canvaser}/{tgl}/{downline}/{produk}/{no_faktur}/{status_penjualan}', 'PenjualanDompulController@update');
Route::get('/invoice_dompul/{canvaser}/{tgl}', 'PenjualanDompulController@data');
Route::get('/edit_invoice_dompul/{canvaser}/{tgl}/{downline}', 'PenjualanDompulController@penjualanData');
Route::get('/edit_list_invoice_dompul/{sales}/{tgl}/{customer}', 'ListPenjualanDompulController@penjualanData');
Route::put('/invoice_dompul/verify/{id}', 'ListPenjualanDompulController@verif');
Route::put('/invoice_dompul/delete', 'ListPenjualanDompulController@delete');

Route::get('/penjualan/sp/invoice-sp', 'PenjualanSPController@index');
Route::post('/get_harga/{tipe}/{kode}', 'PenjualanSPController@getHarga');
// Route::get('/penjualan/sp/invoice-sp-3', function() {
//   return view ('/penjualan/sp/invoice-sp-3');
// }) -> name('invoice-sp-3');

Route::post('/penjualan/sp/invoice-sp/edit', 'PenjualanSPController@edit');
Route::get('/penjualan/sp/invoice-sp/edit/{id}', 'PenjualanSPController@showEdit');
Route::get('/edit_invoice_sp/{id}', 'PenjualanSPController@data');
Route::post('/invoice_sp/update/{id}','PenjualanSPController@update');
Route::post('/invoice_sp/verify','PenjualanSPController@verify');
Route::post('/invoice_sp/store','PenjualanSPController@store');

Route::get('/penjualan/sp/list-invoice-sp', 'ListPenjualanSPController@index');
Route::get('/penjualan/sp/list-invoice-sp/edit/{id_penjualan_sp}/{sales}/{tgl}/{customer}', 'ListPenjualanSPController@edit');
Route::get('/invoice_sp/list/{tgl}', 'ListPenjualanSPController@data');
Route::get('/edit_list_invoice_sp/{id}', 'ListPenjualanSPController@penjualanData');
Route::post('/list_invoice_sp/update/{id}/{id_detail}','ListPenjualanSPController@update');
Route::post('/list_invoice_SP/store','ListPenjualanSPController@store');
Route::put('/invoice_sp/verify/{id}','ListPenjualanSPController@verif');
Route::put('/invoice_sp/delete','ListPenjualanSPController@delete');

Route::get('/master/user', function() {
  return view ('/penjualan/sp/list-invoice-sp');
}) -> name('list-invoice-sp');

//Pembelian
// Route::get('/pembelian/dompul/pembelian-dompul', function() {
//   return view ('/pembelian/dompul/pembelian-dompul');
// }) -> name('pembelian-dompul');

Route::get('/pembelian/sp/pembelian-sp', 'PembelianSPController@index');
Route::post('/pembelian/sp/verify','PembelianSPController@verify');
Route::post('/pembelian/sp/store','PembelianSPController@store');
Route::get('/pembelian_sp_data/{id}', 'PembelianSPController@data');

//Pembelian Dompul
Route::get('/pembelian/dompul/pembelian-dompul', 'PembelianDompulController@index');
Route::post('/pembelian/dompul/verify','PembelianDompulController@verify');
Route::post('/pembelian/dompul/store','PembelianDompulController@store');
Route::get('/pembelian_dompul_data/{id}', 'PembelianDompulController@data');
Route::post('/dompul/get_harga/{tipe}/{kode}', 'PembelianDompulController@getHarga');
Route::get('/pembelian_dompul_data/{id}', 'PembelianDompulController@data');
Route::post('/pembelian/dompul/store','PembelianDompulController@store');


Route::get('/pembelian/dompul/list-pembelian-dompul', function() {
  return view ('/pembelian/dompul/list-pembelian-dompul');
}) -> name('list-pembelian-dompul');

Route::get('/pembelian/sp/list-pembelian-sp', function() {
  return view ('/pembelian/sp/list-pembelian-sp');
}) -> name('list-pembelian-sp');

// Route::get('/pembelian/sp/list-pembelian-sp', function() {
//   return view ('/pembelian/sp/list-pembelian-sp');
// }) -> name('list-pembelian-sp');

Route::get('/pembelian/laporan-pembelian/Lbeli-dompul', function() {
  return view ('/pembelian/laporan-pembelian/Lbeli-dompul');
}) -> name('Lbeli-dompul');

Route::get('/pembelian/laporan-pembelian/Lbeli-sp', function() {
  return view ('/pembelian/laporan-pembelian/Lbeli-sp');
}) -> name('Lbeli-sp');

//monitoring
Route::get('/penjualan/monitoring/mntr-upload', 'MonitorController@index');
Route::get('/penjualan/monitoring/mntr-upload/show', 'MonitorController@show');
Route::get('/monitor-data/{tgl}','MonitorController@data');

// laporan penjualan
Route::get('/penjualan/laporan-penjualan/LPdompul', 'LaporanPenjualanDompulController@index');
Route::get('/penjualan/laporan-penjualan/LPdompul-piutang/{sales}', 'LaporanPenjualanDompulController@detail');
Route::get('/laporan-penjualan/{tgl_penjualan}', 'LaporanPenjualanDompulController@data');
Route::get('/laporan-penjualan/piutang/{id}/{tgl}', 'LaporanPenjualanDompulController@dataPiutang');
Route::post('/get_laporan_dompul/{tgl}', 'LaporanPenjualanDompulController@getData');

Route::get('/penjualan/laporan-penjualan/dompul-head', 'LaporanDompulHeadController@index');
Route::post('/penjualan/laporan-penjualan/dompul-head-show', 'LaporanDompulHeadController@lihatLaporan');
Route::get('/penjualan/laporan-penjualan/dompul-head-user', 'LaporanDompulHeadController@showUserTransaction');
Route::get('/penjualan/laporan-penjualan/dompul-head-server', 'LaporanDompulHeadController@showServerTransaction');

Route::get('/penjualan/laporan-penjualan/LPsp', 'LaporanPenjualanSPController@index');
Route::get('/laporan-penjualan/sp/{tgl_penjualan}', 'LaporanPenjualanSPController@data');
Route::post('/get_laporan_sp/{tgl}', 'LaporanPenjualanSPController@getData');
Route::get('/penjualan/laporan-penjualan/LPsp-piutang/{sales}','LaporanPenjualanSPController@detail');
Route::get('/laporan-penjualan/sp/piutang/{id}/{tgl}', 'LaporanPenjualanSPController@dataPiutang');


//Persediaan
Route::get('/persediaan/mutasi-dompul', 'StokDompulController@index');
Route::get('/stok-dompul/data/{tgl}', 'StokDompulController@data');

Route::get('/persediaan/mutasi-sp', 'StokSpController@index');
Route::get('/stok-sp/data/{tgl}/{sales}', 'StokSpController@data');
//upload
// Route::get('/upload/upload', function() {
//   return view ('/upload/upload');
// }) -> name('upload');
Route::get('/upload/{transfer}/{upload}', 'UploadDompulController@data');
Route::get('upload/dompul', 'UploadDompulController@index');
Route::put('/upload/aktifasi/{tgl_transfer}/{tgl_upload}', 'UploadDompulController@aktifasi');
Route::get('downloadExcel/{type}', 'UploadDompulController@downloadExcel');
Route::post('importExcel', 'UploadDompulController@importExcel');
Route::get('/upload/tgl', 'UploadDompulController@uploadData');
Route::get('/upload/empty', 'UploadDompulController@empty');

//Master
Route::get('/master/user', function() {
  return view ('/master/user');
}) -> name('user');
Route::get('/user-data', 'UsersController@data');

Route::resource('master/bank', 'BankController');
Route::get('bank-data', 'BankController@data');

Route::resource('master/produk', 'ProdukController');
Route::get('/produk-data', 'ProdukController@data');

Route::resource('master/satuan', 'SatuanController');
Route::get('/satuan-data', 'SatuanController@data');

Route::resource('master/supplier', 'SupplierController');
Route::get('/supplier-data', 'SupplierController@data');

Route::resource('master/dompul', 'DompulController');
Route::get('/dompul-data', 'DompulController@data');

Route::resource('master/harga_dompul', 'HargaDompulController');
Route::get('/harga-dompul-data', 'HargaDompulController@data');

Route::resource('master/harga_produk', 'HargaProdukController');
Route::get('/harga-produk-data', 'HargaProdukController@data');

Route::resource('master/tipe_dompul', 'TipeDompulController');
Route::get('/tipe-dompul-data', 'TipeDompulController@data');

//transaction
Route::get('/karoseri/minta_karoseri', function() {
  return view ('/karoseri/minta_karoseri');
}) -> name('karoseri-permintaan');

Route::get('/karoseri/spkc', function() {
  return view ('/karoseri/spkc');
}) -> name('karoseri-spkc');

Route::get('/karoseri/print_spkc', function() {
  return view ('/karoseri/print_spkc');
}) -> name('karoseri-print_spkc');

Route::get('/karoseri/viewprint_spkc', function() {
  return view ('/karoseri/viewprint_spkc');
}) -> name('karoseri-viewprint_spkc');
