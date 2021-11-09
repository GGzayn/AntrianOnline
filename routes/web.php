<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OpdController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\AkunController;
use App\Http\Controllers\LoketController;
use App\Http\Controllers\OfflineRegisterController;
use App\Http\Controllers\AntrianController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\A_kecamatanController;
use App\Http\Controllers\A_kelurahanController;
use App\Http\Controllers\UptController;
use App\Http\Controllers\UptAccountController;
use App\Http\Controllers\AdminDashboard;

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
    return view('auth.login');
});

Auth::routes();
Route::middleware(['cors'])->group(function () {
    Route::middleware('auth')->group( function () {
        Route::middleware('admin')->prefix('admin')->name('admin.')->group( function () {
            Route::resource('opds', OpdController::class);
            Route::resource('akuns', AkunController::class);
            Route::resource('upts', UptController::class);
            Route::resource('uptsAcc', UptAccountController::class);
            Route::resource('a_kecamatans', A_kecamatanController::class);
            Route::resource('a_kelurahans', A_kelurahanController::class)->only(['index']);
            Route::resource('layanans', LayananController::class)->only(['index']);
            Route::resource('lokets', LoketController::class)->only(['index']);
        });

        Route::middleware('kelurahan')->prefix('kelurahan')->name('kelurahan.')->group( function () {
            Route::get('kelurahanBerkas', [DocumentController::class, 'kelurahan_berkas'])->name('kelurahanBerkas');
            Route::post('kirimBerkas', [DocumentController::class, 'kk_berkas'])->name('kirimBerkas');
        });

        Route::middleware('upt')->prefix('upt')->name('upt.')->group( function () {
            Route::resource('offlines', OfflineRegisterController::class);
            Route::resource('a_kelurahans', A_kelurahanController::class);
            Route::resource('lokets', LoketController::class);
            Route::resource('antrians', AntrianController::class);
            Route::resource('documents', DocumentController::class);
            Route::post('berkasKirim', [DocumentController::class, 'berkas_kirim'])->name('berkasKirim');
            Route::get('liveAntrian', [LoketController::class, 'liveAntrian'])->name('liveAntrian');
            Route::get('berkasTercetak', [DocumentController::class, 'c_berkas'])->name('berkasTercetak');
            Route::post('berkasKelurahan', [DocumentController::class, 'ck_berkas'])->name('berkasKelurahan');
            Route::post('statusLoket', [LoketController::class, 'statusLoket'])->name('statusLoket');
            Route::post('hapusLoket', [LoketController::class, 'hapusLoket'])->name('hapusLoket');
            Route::post('statusAntrian', [LoketController::class, 'statusAntrian'])->name('statusAntrian');
            Route::post('hapusAntrian', [LoketController::class, 'hapusAntrian'])->name('hapusAntrian');
            Route::get('scan', [LoketController::class, 'scanQr'])->name('scan');
            Route::get('mobilePrint', [LoketController::class, 'mobilePrint'])->name('mobilePrint');
        });

        Route::middleware('adminUpt')->prefix('adminUpt')->name('adminUpt.')->group( function () {
            Route::resource('dashboard', AdminDashboard::class);
            Route::resource('offlines', OfflineRegisterController::class);
            Route::resource('lokets', LoketController::class);
            Route::resource('documents', DocumentController::class);
            Route::post('berkasKirim', [DocumentController::class, 'berkas_kirim'])->name('berkasKirim');
            Route::get('liveAntrian', [LoketController::class, 'liveAntrian'])->name('liveAntrian');
            Route::get('berkasTercetak', [DocumentController::class, 'c_berkas'])->name('berkasTercetak');
            Route::post('berkasKelurahan', [DocumentController::class, 'ck_berkas'])->name('berkasKelurahan');
            Route::post('statusLoket', [LoketController::class, 'statusLoket'])->name('statusLoket');
            Route::post('hapusLoket', [LoketController::class, 'hapusLoket'])->name('hapusLoket');
            Route::post('statusAntrian', [LoketController::class, 'statusAntrian'])->name('statusAntrian');
            Route::post('hapusAntrian', [LoketController::class, 'hapusAntrian'])->name('hapusAntrian');
            Route::get('scan', [LoketController::class, 'scanQr'])->name('scan');
            Route::get('mobilePrint', [LoketController::class, 'mobilePrint'])->name('mobilePrint');
        });

        Route::middleware('kecamatan')->prefix('kecamatan')->name('kecamatan.')->group( function () {
            Route::resource('dashboard', AdminDashboard::class);
            Route::resource('a_kelurahans', A_kelurahanController::class);
            Route::resource('lokets', LoketController::class);
            Route::resource('antrians', AntrianController::class);
            Route::resource('offlines', OfflineRegisterController::class);
            Route::resource('documents', DocumentController::class);
            Route::post('berkasKirim', [DocumentController::class, 'berkas_kirim'])->name('berkasKirim');
            Route::get('liveAntrian', [LoketController::class, 'liveAntrian'])->name('liveAntrian');
            Route::get('berkasTercetak', [DocumentController::class, 'c_berkas'])->name('berkasTercetak');
            Route::post('berkasKelurahan', [DocumentController::class, 'ck_berkas'])->name('berkasKelurahan');
            Route::get('scan', [LoketController::class, 'scanQr'])->name('scan');
            Route::get('mobilePrint', [LoketController::class, 'mobilePrint'])->name('mobilePrint');
        });

        Route::middleware('loketKecamatan')->prefix('loketKecamatan')->name('loketKecamatan.')->group( function () {
            Route::resource('antrians', AntrianController::class);
            Route::resource('documents', DocumentController::class);
            Route::post('statusLoket', [LoketController::class, 'statusLoket'])->name('statusLoket');
            Route::post('hapusLoket', [LoketController::class, 'hapusLoket'])->name('hapusLoket');
            Route::post('statusAntrian', [LoketController::class, 'statusAntrian'])->name('statusAntrian');
            Route::post('hapusAntrian', [LoketController::class, 'hapusAntrian'])->name('hapusAntrian');
        });

        Route::middleware('dinas')->prefix('dinas')->name('dinas.')->group( function () {
            Route::resource('dashboard', AdminDashboard::class);
            Route::resource('layanans', LayananController::class);
            Route::resource('lokets', LoketController::class);
            Route::resource('documents', DocumentController::class);
            Route::resource('offlines', OfflineRegisterController::class);
            Route::resource('antrians', AntrianController::class)->only(['index']);
            Route::get('liveAntrian', [LoketController::class, 'liveAntrian'])->name('liveAntrian');
            Route::get('export', [LoketController::class, 'exportPDF'])->name('export');
            Route::get('exportMonth', [LoketController::class, 'exportPDFMonth'])->name('exportMonth');
            Route::post('statusLoket', [LoketController::class, 'statusLoket'])->name('statusLoket');
            Route::post('hapusLoket', [LoketController::class, 'hapusLoket'])->name('hapusLoket');
            Route::post('berkasKirim', [DocumentController::class, 'berkas_kirim'])->name('berkasKirim');
            Route::get('scan', [LoketController::class, 'scanQr'])->name('scan');
            Route::get('mobilePrint', [LoketController::class, 'mobilePrint'])->name('mobilePrint');
        });

        Route::middleware('loket')->prefix('loket')->name('loket.')->group( function () {
            Route::resource('antrians', AntrianController::class);
            Route::resource('documents', DocumentController::class);
            Route::post('statusLoket', [LoketController::class, 'statusLoket'])->name('statusLoket');
            Route::post('hapusLoket', [LoketController::class, 'hapusLoket'])->name('hapusLoket');
            Route::post('statusAntrian', [LoketController::class, 'statusAntrian'])->name('statusAntrian');
            Route::post('hapusAntrian', [LoketController::class, 'hapusAntrian'])->name('hapusAntrian');
           
            
        });
        
        Route::get('home', [HomeController::class, 'index'])->name('home');
        // Route::get('scan', [LoketController::class, 'scanQr'])->name('scan');
        Route::get('mobilePrint', [LoketController::class, 'mobilePrint'])->name('mobilePrint');
        Route::get('laporan', [DocumentController::class, 'report_v'])->name('laporan');
        Route::post('laporanBerkas', [DocumentController::class, 'report'])->name('laporanBerkas');
        
    
    });
});


