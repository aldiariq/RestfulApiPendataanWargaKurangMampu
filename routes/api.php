<?php

use App\Http\Controllers\DataRukunTetanggaController;
use App\Models\DataRukunTetangga;
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
Route::put('rukuntetangga/{id}', [DataRukunTetanggaController::class, 'update']);
Route::delete('rukuntetangga/{id}', [DataRukunTetanggaController::class, 'delete']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
