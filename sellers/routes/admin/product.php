<?php

use Illuminate\Support\Facades\Route;

Route::get('/admin/seller/products', [App\Http\Controllers\Admin\SellerProductController::class, 'products']);
Route::get('/admin/seller/product/{id}', [App\Http\Controllers\Admin\SellerProductController::class, 'product']);
Route::get('/admin/seller/product/{id}/{sellerId}', [App\Http\Controllers\Admin\SellerProductController::class, 'product']);
Route::get('/admin/admin-product/{id}', [App\Http\Controllers\Admin\SellerProductController::class, 'adminProduct']);

Route::get('/admin/seller/product-stocks', [App\Http\Controllers\Admin\SellerProductController::class, 'stocks']);


Route::post('/admin/seller/product/validate', [App\Http\Controllers\Admin\SellerProductController::class, 'validateProduct']);
Route::post('/admin/seller/product/save', [App\Http\Controllers\Admin\SellerProductController::class, 'saveProduct']);
Route::post('/admin/seller/product/updateStatus', [App\Http\Controllers\Admin\SellerProductController::class, 'updateStatus']);

Route::post('/admin/seller/product-stock/add', [App\Http\Controllers\Admin\SellerProductController::class, 'stock']);
Route::post('/admin/seller/product-stock/save', [App\Http\Controllers\Admin\SellerProductController::class, 'saveStock']);


