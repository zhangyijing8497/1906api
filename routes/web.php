<?php

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

// phpinfo页面
Route::get('/phpinfo',function(){
    phpinfo();
});

// 测试
Route::prefix('/test/')->group(function(){
    Route::get('redis','TestController@testRedis');
    Route::get('test1','TestController@test1');
    Route::get('test2','TestController@test2');
});

Route::prefix('/api/')->group(function(){
    Route::get('user/info','Api\UserController@info');
    Route::post('user/reg','Api\UserController@reg');  //用户注册
});
