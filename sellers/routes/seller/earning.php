<?php

use Illuminate\Support\Facades\Route;

Route::get('/earnings', [App\Http\Controllers\SellerEarningController::class, 'earnings']);
Route::get('/settlements', [App\Http\Controllers\SellerEarningController::class, 'settlements']);
Route::get('/settlements/{id}', [App\Http\Controllers\SellerEarningController::class, 'settlements']);
Route::get('/payment/{id}', [App\Http\Controllers\SellerEarningController::class, 'payment']);


Route::post('/settlement/save', [App\Http\Controllers\SellerEarningController::class, 'saveSettltment']);

Route::post('earnings-filter/', [App\Http\Controllers\Admin\SellerEarningController::class, 'earnings_filter']);
