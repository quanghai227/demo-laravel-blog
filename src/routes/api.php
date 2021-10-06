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

Route::post('/register', 'ApiUserController@register');

Route::post('/login', 'ApiUserController@login');
Route::post('/user', 'ApiUserController@userInfo')->middleware('auth:api');


Route::resource('/post', 'ApiPostController')->parameters([
    'index' => 'page'
])->middleware('auth:api');