<?php

use App\Http\Controllers\Api\V1\ProductController;
use Illuminate\Support\Facades\Route;
use function Laravel\Prompts\search;

Route::group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers\Api\V1'], function() {
    
    Route::post('products/search', 'ProductController@search')->name('products.search');
    Route::resource('products', 'ProductController', ['except' => ['create', 'edit']]);
    // Route::resource('products', ProductController::class, ['except' => ['create', 'edit']]);
    
});