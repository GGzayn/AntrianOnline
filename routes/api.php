<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OpdController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\AkunController;
use App\Http\Controllers\LoketController;
use App\Http\Controllers\OfflineRegisterController;
use App\Http\Controllers\AntrianController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\UptController;
use App\Http\Controllers\Syarat;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('pengguna', [AkunController::class, 'pengguna'])->name('pengguna');
Route::get('role', [AkunController::class, 'role'])->name('role');
Route::get('pengaju', [AntrianController::class, 'pengaju'])->name('pengaju');
Route::get('listOpd', [OpdController::class, 'MobileOpdList'])->name('listOpd');
Route::get('listLayanan', [LayananController::class, 'MobileLayananList'])->name('listLayanan');
Route::post('timeAvailable', [OfflineRegisterController::class, 'MobileTimeAvail'])->name('timeAvailable');
Route::post('mobileReg', [AntrianController::class, 'MobileRegister'])->name('mobileReg');
Route::post('test', [AntrianController::class, 'test'])->name('test');
Route::get('historyAntrian/{nik}', [AntrianController::class, 'historyAntrian'])->name('historyAntrian');
Route::get('allAntrian/{nik}', [AntrianController::class, 'homeAntrian'])->name('allAntrian');
Route::get('listLoket/{id}', [LoketController::class, 'MobileLoket'])->name('listLoket');
Route::get('uptloket/{id}/{layanan_id}', [LoketController::class, 'UptLoket'])->name('uptloket');
Route::get('statusBerkas/{id}', [DocumentController::class, 'get_berkas'])->name('statusBerkas');
Route::post('berkas', [DocumentController::class, 'post_berkas'])->name('berkas');
Route::get('berkasPengguna', [DocumentController::class, 'g_berkas'])->name('berkasPengguna');
Route::post('status_kirim/{id}', [DocumentController::class, 'status_kirim'])->name('status_kirim');
Route::get('show_upt', [UptController::class, 'show_upt'])->name('show_upt');
Route::get('upt', [LayananController::class, 'showUpt'])->name('upt');
Route::get('syarat/{id}', [Syarat::class, 'mobileSyarat'])->name('syarat');