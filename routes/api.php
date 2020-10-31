<?php

use Illuminate\Http\Request;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::post('login', 'ApiController@login');
// Route::post('register', 'ApiController@register');
 
//     Route::group(['middleware' => 'auth.jwt'], function () {
//     Route::get('logout', 'ApiController@logout');
 
//     Route::get('user', 'ApiController@getAuthUser');
 
//     Route::get('products', 'ProductController@index');
//     Route::get('products/{id}', 'ProductController@show');
//     Route::post('products', 'ProductController@store');
//     Route::put('products/{id}', 'ProductController@update');
//     Route::delete('products/{id}', 'ProductController@destroy');
// });

Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('login', 'App\Http\Controllers\AuthController@login');
    Route::post('signup', 'App\Http\Controllers\AuthController@signup');
    Route::get('unauthenticate', 'App\Http\Controllers\AuthController@unauthenticate')->name('unauthenticate');
  
    Route::group([
      'middleware' => 'auth:api'
    ], function() {
        Route::get('logout', 'AuthController@logout');
        Route::get('user', 'App\Http\Controllers\AuthController@user');
    });
});

Route::group([
    'middleware' => 'auth:api',
    'prefix' => 'products'
], function () {
    Route::get('', 'App\Http\Controllers\ProductController@index');
    Route::get('/{id}', 'App\Http\Controllers\ProductController@show');
    Route::post('', 'App\Http\Controllers\ProductController@store');
    Route::put('/{id}', 'App\Http\Controllers\ProductController@update');
    Route::delete('/{id}', 'App\Http\Controllers\ProductController@destroy');
});


Route::group([
    'middleware' => 'auth:api',
    'prefix' => 'classdemo'
], function () {
    Route::post('create', 'App\Http\Controllers\ClassdemoController@create');
});