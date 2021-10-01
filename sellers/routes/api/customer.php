<?php

use Illuminate\Support\Facades\Route;

Route::post('/customerapi/customer-register', [App\Http\Controllers\Api\Customer\CustomerAuth_Api::class, 'register']);
Route::get('/customerapi/homepage', [App\Http\Controllers\Api\Customer\Homepage::class, 'index']);
Route::get('/customerapi/homepage/product-category/{id}', [App\Http\Controllers\Api\Customer\Homepage::class, 'product_by_category']);