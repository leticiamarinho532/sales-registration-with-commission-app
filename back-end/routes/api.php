<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\SellersController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/sale/create/', [SalesController::class, 'createSale']);
Route::get('/sale/{sellerId}/show/', [SalesController::class, 'GetAllSellerSales']);
Route::post('/seller/create/', [SellersController::class, 'createSeller']);
Route::get('/seller/show/', [SellersController::class, 'getAllSellers']);
