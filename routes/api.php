<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PriceController;
use App\Http\Controllers\CurrencyController;

Route::apiResource('products', ProductController::class);
Route::get('/products/{id}/prices', [PriceController::class, 'index']);
Route::post('/products/{id}/prices', [PriceController::class, 'store']);
Route::apiResource('currencies', CurrencyController::class);
