<?php

use App\Http\Controllers\Api\CartController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
//middleware('auth:sanctum')->
Route::middleware('auth:sanctum')->group(function(){
    Route::get('/user', function (Request $request) {
        return $request->user();
    })->name('user');

    Route::get('product/increase/{id}', [CartController::class, 'increase'])->name('increasequantity');
    Route::get('product/decrease/{id}', [CartController::class, 'decrease'])->name('decreasequantity');

    Route::get('products/count', [CartController::class, 'count'])->name('products.count');

    //Route::get('cart/content', [CartController::class, 'index'])->name('cart.content');

    Route::apiResource('products', CartController::class);

});
