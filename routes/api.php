<?php

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

Route::get('/posts', 'Api\PostController@index');
Route::get('/posts/{id}', 'Api\PostController@get');

Route::middleware('auth:api')->group( function () {
    Route::post('/posts', 'Api\PostController@create');
    Route::put('/posts', 'Api\PostController@update');
});

