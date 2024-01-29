<?php

use App\Http\Controllers\Api\V1\ProductController;
use Illuminate\Support\Facades\Route;use function Laravel\Prompts\search;

Route::group(['prefix' => 'v1'], function() {

    Route::post('products/search', 'Api\V1\ProductController@search');

    //Route::post('products/search', '\Api\V1\ProductController@search');
    // Route::resource('products', ProductController::class, ['except' => ['create', 'edit']]);
});




// Produtos
//Route::get('products', 'ProductController@index');
//Route::apiResource('products', '\App\Http\Controllers\API\ProductController'); -->