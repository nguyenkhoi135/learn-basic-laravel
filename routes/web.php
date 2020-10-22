<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('string', function () {
    return 'Hello world!';
});


Route::get('json', function () {
    return ['foo' => 'bar'];
});

Route::get('info/{detail}', function ($detail) {
    $details = [
        'my-first-detail' => 'This is my first detail.',
        'my-second-detail' => 'This is my second detail.'
    ];
    if (!array_key_exists($detail,$details)) {
        abort(404, 'Sorry, that detail was not found.');
    }
    return view('info', [
        'detail' => $details[$detail]
    ]);
});

Route::get('info/{detail}', 'InfosController@show');

Route::get('test', 'App\Http\Controllers\AuthController@test');
