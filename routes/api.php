<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\SaleController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::apiResource('/vendedores', SellerController::class);
Route::post('/venda', [SaleController::class, 'store']);
Route::get('/venda/{id}', [SaleController::class, 'show']);
Route::get('/', function () {
    return ['Laravel' => app()->version()];
});