<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/products/get/id/{id}', [ProductsController::class, 'getProductById']);
Route::get('/products/get/slug/{slug}', [ProductsController::class, 'getProductBySlug']);
Route::post('/products/insert', [ProductsController::class, 'insertProduct']);
Route::post('/products/update/id/{id}', [ProductsController::class, 'updateProductById']);
Route::get('/products/delete/id/{id}', [ProductsController::class, 'deleteProductById']);

Route::post('/product_images/insert', [ProductImagesController::class, 'insertProductImage']);
Route::post('/product_images/update/id/{id}', [ProductImagesController::class, 'updateProductImageById']);
Route::get('/product_images/delete/id/{id}', [ProductImagesController::class, 'deleteProductImageById']);

Route::post('/product_discounts/insert', [ProductDiscountsController::class, 'insertProductDiscount']);
Route::post('/product_discounts/update/id/{id}', [ProductDiscountsController::class, 'updateProductDiscountById']);
Route::get('/product_discounts/delete/id/{id}', [ProductDiscountsController::class, 'deleteProductDiscountById']);
