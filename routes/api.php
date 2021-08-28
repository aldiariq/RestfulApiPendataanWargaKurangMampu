<?php

use App\Http\Controllers\DataRukunTetanggaController;
use App\Http\Controllers\DataMasyarakatController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

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

Route::get('tambahakunadmin', [AuthController::class, 'tambahakunadmin']);
Route::post('masuk', [AuthController::class, 'masuk']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('keluar', [AuthController::class, 'keluar']);

    Route::get('rukuntetangga', [DataRukunTetanggaController::class, 'index']);
    Route::get('rukuntetangga/{id}', [DataRukunTetanggaController::class, 'show']);
    Route::post('rukuntetangga', [DataRukunTetanggaController::class, 'store']);
    Route::post('rukuntetangga/{id}', [DataRukunTetanggaController::class, 'update']);
    Route::delete('rukuntetangga/{id}', [DataRukunTetanggaController::class, 'destroy']);

    Route::get('masyarakat', [DataMasyarakatController::class, 'index']);
    Route::get('masyarakat/{id}', [DataMasyarakatController::class, 'show']);
    Route::post('masyarakat', [DataMasyarakatController::class, 'store']);
    Route::post('masyarakat/{id}', [DataMasyarakatController::class, 'update']);
    Route::delete('masyarakat/{id}', [DataMasyarakatController::class, 'destroy']);
});

Route::get('/', function () {
    $keterangan = array(
        'status' => true,
        'pesan' => 'RestfulAPI Pendataan Warga Kurang Mampu'
    );

    return response()->json($keterangan);
});

Route::fallback(function () {
    return redirect('/api');
});
