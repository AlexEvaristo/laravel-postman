<?php

use App\Http\Controllers\Api\V1\ProductController;
use App\Http\Controllers\Api\V1\UnityController;
use Illuminate\Support\Facades\Route;
use function Laravel\Prompts\search;

Route::group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers\Api\V1'], function() {

    Route::post('products/search', 'ProductController@search')->name('products.search');
    Route::resource('products', 'ProductController', ['except' => ['create', 'edit']]);

    Route::post('unities/search', 'UnityController@search')->name('unities.search');
    Route::resource('unities', 'UnityController', ['except' => ['create', 'edit']]);

    Route::post('categories/search', 'CategoryController@search')->name('categories.search');
    Route::resource('categories', 'CategoryController', ['except' => ['create', 'edit']]);

});