<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ProductImagesController;
use App\Http\Controllers\ProductDiscountsController;

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


Route::post('/user/login', [UserController::class, 'Login']);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('login', ['as'=>'login', 'uses' => 'App\Http\Controllers\LoginController@Login']);

Route::middleware('auth:sanctum')->get('/products/get/id/{id}', [ProductsController::class, 'getProductById']);
Route::middleware('auth:sanctum')->get('/products/get/slug/{slug}', [ProductsController::class, 'getProductBySlug']);
Route::middleware('auth:sanctum')->post('/products/insert', [ProductsController::class, 'insertProduct']);
Route::middleware('auth:sanctum')->post('/products/update/id/{id}', [ProductsController::class, 'updateProductById']);
Route::middleware('auth:sanctum')->get('/products/delete/id/{id}', [ProductsController::class, 'deleteProductById']);

Route::middleware('auth:sanctum')->post('/product_images/insert', [ProductImagesController::class, 'insertProductImage']);
Route::middleware('auth:sanctum')->post('/product_images/update/id/{id}', [ProductImagesController::class, 'updateProductImageById']);
Route::middleware('auth:sanctum')->get('/product_images/delete/id/{id}', [ProductImagesController::class, 'deleteProductImageById']);

Route::middleware('auth:sanctum')->post('/product_discounts/insert', [ProductDiscountsController::class, 'insertProductDiscount']);
Route::middleware('auth:sanctum')->post('/product_discounts/update/id/{id}', [ProductDiscountsController::class, 'updateProductDiscountById']);
Route::middleware('auth:sanctum')->get('/product_discounts/delete/id/{id}', [ProductDiscountsController::class, 'deleteProductDiscountById']);
