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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'api'], function ($router) {
    // ログインを行ない、アクセストークンを発行するルート
    Route::post('/users/login', 'User\\LoginAction');

    Route::get('/users', 'UserAction');
    // アクセストークンを用いて、認証ユーザーの情報を取得するルート
    Route::post('/users/', 'User\\RetrieveAction')->middleware('auth:api');
});
