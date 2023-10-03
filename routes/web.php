<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\SuratpoController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SuppliersController;
use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\UsersController;

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

Route::get('/', [DashboardController::class, 'index'])->middleware('auth');
Route::get('/home', [DashboardController::class, 'index'])->middleware('auth');

Route::controller(LoginController::class)->group(function () {
    Route::get('login', 'index')->name('login');
    Route::post('login.proses', 'proses');
    Route::get('logout', 'logout');
});

Route::group(['middleware' => ['auth']], function () {
    Route::group(['middleware' => ['CekUserLogin:purchasing']], function () {
        Route::get('/suratpo', [SuratpoController::class, 'formPO'])->name('suratpo.form');
        Route::post('/suratpo', [SuratpoController::class, 'store'])->name('suratpo.store');
        Route::get('/newpo', [SuratpoController::class, 'indexnewpo'])->name('suratpo.index');
        Route::delete('/newpo/{modalId}', [SuratpoController::class, 'delete'])->name('suratpo.delete');
        Route::get('/schedule', [DeliveryController::class, 'index'])->name('schedule.index');
        Route::put('/schedule/{suratpo}', [DeliveryController::class, 'update'])->name('schedule.update');

});

Route::group(['middleware' => ['CekUserLogin:ppic']], function () {
    Route::resource('/suppliers', SuppliersController::class);
    Route::resource('/barang', BarangController::class);
    Route::resource('/users', UsersController::class);
    Route::get('/penerimaan', [DeliveryController::class, 'indexpenerimaan'])->name('penerimaan.index');
    Route::get('/penerimaan/details/{id}', [DeliveryController::class, 'penerimaandetail'])->name('penerimaan.detailsuratjalan');
    Route::post('penerimaan/setuju/{id}', [DeliveryController::class, 'setujuSuratJalan'])->name('penerimaan.setuju');
    Route::get('/laporan',[SuratpoController::class, 'laporan'])->name('laporan.index');

});

Route::group(['middleware' => ['CekUserLogin:direktur']], function () {
    Route::get('/validasiPO', [SuratpoController::class, 'indexdirektur'])->name('direktur.index');
    Route::get('/validasiPO/{modalId}', [SuratpoController::class, 'validasi'])->name('suratpo.validate');
    Route::get('/rekap',[SuratpoController::class, 'laporan'])->name('laporan.index');

});

Route::group(['middleware' => ['CekUserLogin:supplier']], function () {
    Route::get('/pengirimanpo', [DeliveryController::class, 'indexpengirimanPO'])->name('pengirimanpo.index');
    Route::post('/pengirimanpo/formsuratjalan', [DeliveryController::class, 'store'])->name('suratjalan.store');
        
});


 });

