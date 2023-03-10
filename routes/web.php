<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KensaController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\MasterDataController;
use App\Http\Controllers\MasterKensaController;
use App\Http\Controllers\PinboshTertinggalController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RackingController_T;
use App\Http\Controllers\RencanaProduksiController;
use App\Http\Controllers\StokController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\UnrackingController_T;
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

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

Route::redirect('/', 'login');

Route::get('/dashboard', [DashboardController::class, 'home'])->middleware(['auth'])->name('dashboard');

Route::controller(AdminController::class)->middleware(['auth'])->group(function () {
    Route::get('/admin/logout', 'destroy')->name('admin.logout');
    Route::get('/admin/profile', 'profile')->name('admin.profile');
    Route::get('/admin/edit/profile', 'editprofile')->name('edit.profile');
    Route::post('/store/profile', 'storeprofile')->name('store.profile');
});

// Supplier All Route
Route::controller(MasterDataController::class)->middleware(['auth'])->group(function () {
    Route::get('/supplier/all', 'SupplierAll')->name('supplier.all');
    Route::get('masterdata', 'index')->name('master');
    Route::get('masterdata/tambah', 'tambah')->name('master.tambah');
    Route::post('masterdata', 'simpan')->name('master.simpan');
    Route::post('masterdata/destroy/{id}', 'destroy')->name('master.destroy');
    Route::get('masterdata/{id}/edit', 'edit')->name('master.edit');
    Route::get('masterdata/{id}/show', 'show')->name('master.show');
    Route::patch('masterdata/{id}', 'update')->name('master.update');
    Route::get('masterdata/export_excel', 'exportexcel')->name('master.export');
    Route::post('masterdata/import_excel', 'importexcel')->name('master.import');
    Route::get('masterdata/search', 'search')->name('master.search');
    Route::get('/masterdata/{id}', 'getDataParts');
});

Route::controller(RackingController_T::class)->middleware(['auth'])->group(function () {
    Route::get('racking_t', 'index')->name('racking_t');
    Route::get('racking_t/tambah', 'tambah')->name('racking_t.tambah');
    Route::post('racking_t', 'simpan')->name('racking_t.simpan');
    Route::post('racking_t/delete/{id}', 'delete')->name('racking_t.delete');
    Route::get('racking_t/{id}/edit', 'edit')->name('racking_t.edit');
    Route::patch('racking_t/{id}', 'update')->name('racking_t.update');
    Route::get('racking_t/ajax', 'ajaxRacking')->name('racking_t.ajax');
    Route::get('racking_t/findMasterdata', 'findMasterdata')->name('findMasterdata');
    Route::get('racking_t/utama', 'utama')->name('racking_t.utama');
    Route::get('racking_t/ngracking', 'ngracking')->name('ngracking');
    Route::get('racking_t/ngracking/tambah', 'tambahngracking')->name('ngracking.tambah');
    Route::post('racking_t/ngracking/simpan', 'simpanngracking')->name('ngracking.simpan');
    Route::get('racking_t/pinbosh_tertinggal', 'pinbosh')->name('pinbosh');
    Route::get('racking_t/pinbosh_tertinggal/tambah', 'pinboshTambah')->name('pinbosh.tambah');
});

Route::controller(UnrackingController_T::class)->middleware(['auth'])->group(function () {
    Route::get('unracking_t', 'index')->name('unracking_t');
    Route::post('unracking_t', 'simpan')->name('unracking_t.simpan');
    // Route::delete('unracking_t/delete/{id}', 'delete')->name('unracking_t.delete');
    Route::get('unracking_t/{id}/edit', 'edit')->name('unracking_t.edit');
    Route::patch('unracking_t/{id}', 'update')->name('unracking_t.update');
    Route::get('unracking_t/print/{id}', 'unrackingPrint')->name('unracking_t.print');
});

Route::controller(KensaController::class)->middleware(['auth'])->group(function () {
    Route::get('kensa', 'index')->name('kensa');
    Route::get('kensa/tambah', 'tambah')->name('kensa.tambah');
    Route::post('kensa', 'simpan')->name('kensa.simpan');
    Route::post('kensa/delete/{id}', 'delete')->name('kensa.delete');
    Route::get('kensa/{id}/edit', 'edit')->name('kensa.edit');
    Route::patch('kensa/{id}', 'update')->name('kensa.update');
    Route::get('kensa/export_excel', 'exportexcel')->name('kensa.export');
    Route::get('kensa/autocomplete/{id}', 'autocomplete')->name('autocomplete_t');
    Route::get('kensa/search', 'search')->name('kensa.search');
    Route::get('kensa/searchdater', 'searchDater')->name('kensa.searchDate');
    Route::get('kensa/pengiriman', 'pengiriman')->name('kensa.pengiriman');
    Route::get('kensa/print_kanban', 'printKanban')->name('kensa.printKanban');
    Route::post('kensa/print_kanban/simpan', 'kanbansimpan')->name('kensa.kanban-simpan');
    Route::get('kensa/print_kanban/ajax', 'ajaxKanban')->name('kensa.ajaxKanban');
    Route::get('kensa/ajax', 'ajax')->name('kensa.ajax');
    Route::get('kensa/print_kanban/cetak_kanban/{id}', 'cetak_kanban')->name('kensa.cetak_kanban');
    Route::get('kensa/print_kanban/cetak_kanbane/', 'cetak_kanbane')->name('kensa.cetak_kanbane');
    Route::get('kensa/utama', 'utama')->name('kensa.utama');
});

Route::controller(LaporanController::class)->middleware(['auth'])->group(function () {
    Route::get('laporan', 'index')->name('laporan');
    Route::get('laporan/getData', 'getData')->name('laporan.getdata');
    Route::get('laporan/kensa', 'kensa')->name('laporan.kensa');
});

Route::get('stok', [StokController::class, 'index'])->name('stok');
Route::get('stok_bc', [StokController::class, 'index2'])->name('stok_bc');
Route::get('masterkensa', [MasterKensaController::class, 'index'])->name('msterkensa');
Route::get('masterdata/downloadPDF/{id}', [MasterDataController::class, 'downloadPDF'])->name('masterdata.downloadPDF');

Route::get('lihatPart', [StokController::class, 'lihatPart'])->name('lihatPart');
Route::get('cariPart', [StokController::class, 'cariPart'])->name('cariPart');

Route::get('rencana_produksi', [RencanaProduksiController::class, 'index'])->name('rencana_produksi');
Route::post('rencana_produksi/import_excel', [RencanaProduksiController::class, 'import_excel'])->name('rencana_produksi.import_excel');






Route::get('barang', [BarangController::class, 'index'])->name('barang');
Route::get('barang/create', [BarangController::class, 'create'])->name('barang.tambah');
Route::post('barang/simpan', [BarangController::class, 'store'])->name('barang.simpan');
Route::get('barang/export_excel',[BarangController::class, 'export_excel'])->name('barang.export');
Route::post('barang/import_excel',[BarangController::class, 'import_excel'])->name('barang.import');

Route::resource('transaksi', TransaksiController::class);
Route::get('/transaksi/destroy/{id}', [TransaksiController::class, 'destroy']);

Route::get('product', [ProductController::class,'index'])->name('product');
Route::get('product/getDataProduct', [ProductController::class,'getDataProduct'])->name('product.getdata');




// Route::get('transaksi', [TransaksiController::class, 'index'])->name('transaksi');
// Route::get('transaksi/create', [TransaksiController::class, 'create'])->name('transaksi.tambah');
// Route::post('transaksi/simpan', [TransaksiController::class, 'store'])->name('transaksi.simpan');
// Route::get('transaksi/edit/{id}', [TransaksiController::class, 'edit'])->name('transaksi.edit');
// Route::get('transaksi/hapus/{id}', [TransaksiController::class, 'destroy'])->name('transaksi.hapus');

require __DIR__ . '/auth.php';
