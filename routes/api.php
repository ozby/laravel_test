<?php

use Illuminate\Http\Request;

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

Route::middleware('auth.basic')->get('/list', 'MessageController@index');
Route::middleware('auth.basic')->get('/message/{uid}', 'MessageController@read')->where('uid', '[0-9]+');
