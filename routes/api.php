<?php

use App\Http\Controllers\DataRukunTetanggaController;
use App\Http\Controllers\DataMasyarakatController;
use Illuminate\Http\Request;
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

Route::get('rukuntetangga', [DataRukunTetanggaController::class, 'index']);
Route::get('rukuntetangga/{id}', [DataRukunTetanggaController::class, 'show']);
Route::post('rukuntetangga', [DataRukunTetanggaController::class, 'store']);
Route::post('rukuntetangga/{id}', [DataRukunTetanggaController::class, 'update']);
Route::delete('rukuntetangga/{id}', [DataRukunTetanggaController::class, 'delete']);

Route::get('masyarakat', [DataMasyarakatController::class, 'index']);
Route::get('masyarakat/{id}', [DataMasyarakatController::class, 'show']);
Route::post('masyarakat', [DataMasyarakatController::class, 'store']);
Route::post('masyarakat/{id}', [DataMasyarakatController::class, 'update']);
Route::delete('masyarakat/{id}', [DataMasyarakatController::class, 'delete']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
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
