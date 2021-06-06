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

Route::get('listOpd', [OpdController::class, 'MobileOpdList'])->name('listOpd');
Route::get('listLayanan', [LayananController::class, 'MobileLayananList'])->name('listLayanan');
Route::post('timeAvailable', [OfflineRegisterController::class, 'MobileTimeAvail'])->name('timeAvailable');
Route::post('mobileReg', [AntrianController::class, 'MobileRegister'])->name('mobileReg');
Route::post('test', [AntrianController::class, 'test'])->name('test');
Route::get('historyAntrian/{nik}', [AntrianController::class, 'historyAntrian'])->name('historyAntrian');
Route::get('allAntrian/{nik}', [AntrianController::class, 'homeAntrian'])->name('allAntrian');
Route::get('listLoket/{layanan}', [LoketController::class, 'MobileLoket'])->name('listLoket');