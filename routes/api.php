<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Production\ProductionController;

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

Route::get('/getCars', [ProductionController::class, 'getCars']);
Route::post('/transfer', [ProductionController::class, 'transfer']);

Route::post('/backTransfer', [ProductionController::class, 'backTransfer']);

Route::get('/getProducts/{id}', [ProductionController::class, 'getProducts']);
Route::get('/getHolds/{id}', [ProductionController::class, 'getHolds']);