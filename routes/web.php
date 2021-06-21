<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OpdController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\AkunController;
use App\Http\Controllers\LoketController;
use App\Http\Controllers\OfflineRegisterController;
use App\Http\Controllers\AntrianController;

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
    return view('auth.sign');
});

Auth::routes();
Route::middleware(['cors'])->group(function () {
    Route::middleware('auth')->group( function () {
        Route::middleware('admin')->prefix('admin')->name('admin.')->group( function () {
            Route::resource('opds', OpdController::class);
            Route::resource('akuns', AkunController::class);
            Route::resource('layanans', LayananController::class)->only(['index']);
            Route::resource('lokets', LoketController::class)->only(['index']);
        });

        Route::middleware('dinas')->prefix('dinas')->name('dinas.')->group( function () {
            Route::resource('layanans', LayananController::class);
            Route::resource('lokets', LoketController::class);
            Route::resource('offlines', OfflineRegisterController::class);
            Route::resource('antrians', AntrianController::class)->only(['index']);
            Route::get('liveAntrian', [LoketController::class, 'liveAntrian'])->name('liveAntrian');
            Route::get('export', [LoketController::class, 'exportPDF'])->name('export');
            Route::get('exportMonth', [LoketController::class, 'exportPDFMonth'])->name('exportMonth');
            Route::post('statusLoket', [LoketController::class, 'statusLoket'])->name('statusLoket');
            Route::post('hapusLoket', [LoketController::class, 'hapusLoket'])->name('hapusLoket');
        });

        Route::middleware('loket')->prefix('loket')->name('loket.')->group( function () {
            Route::resource('layanans', LayananController::class)->only(['index']);
            Route::resource('lokets', LoketController::class);
            Route::resource('antrians', AntrianController::class);
            Route::post('statusLoket', [LoketController::class, 'statusLoket'])->name('statusLoket');
            Route::post('hapusLoket', [LoketController::class, 'hapusLoket'])->name('hapusLoket');
            Route::post('statusAntrian', [LoketController::class, 'statusAntrian'])->name('statusAntrian');
            Route::post('hapusAntrian', [LoketController::class, 'hapusAntrian'])->name('hapusAntrian');
            
        });
        
        Route::get('home', [HomeController::class, 'index'])->name('home');
        Route::get('scan', [LoketController::class, 'scanQr'])->name('scan');
        Route::get('mobilePrint', [LoketController::class, 'mobilePrint'])->name('mobilePrint');
        
    
    });
});


