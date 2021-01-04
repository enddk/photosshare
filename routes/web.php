<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;

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
Auth::routes();

Route::get('index', 'App\Http\Controllers\PhotosController@index')->name('index');

Route::get('index/add', 'App\Http\Controllers\PhotosController@add')->middleware('App\Http\Middleware\UserMiddleware::class');

Route::post('index/add', 'App\Http\Controllers\PhotosController@create')->middleware('App\Http\Middleware\UserMiddleware::class');

Route::get('index/view', 'App\Http\Controllers\PhotosController@view')->middleware('App\Http\Middleware\UserMiddleware::class');

Route::get('index/login', 'App\Http\Controllers\PhotosController@login')->name('login')->middleware('App\Http\Middleware\loginMiddleware::class');

Route::get('index/signin', 'App\Http\Controllers\PhotosController@signin')->name('signin')->middleware('App\Http\Middleware\loginMiddleware::class');

Route::post('index/login', 'App\Http\Controllers\PhotosController@logup');

Route::post('index/signin', 'App\Http\Controllers\PhotosController@signup')->name('signin');

Route::get('index/logout', 'App\Http\Controllers\PhotosController@logout')->middleware('App\Http\Middleware\UserMiddleware::class');

Route::get('index/mypage', 'App\Http\Controllers\PhotosController@mypage')->middleware('App\Http\Middleware\UserMiddleware::class');

Route::get('index/profile', 'App\Http\Controllers\PhotosController@profile')->middleware('App\Http\Middleware\UserMiddleware::class');

Route::post('index/delete','App\Http\Controllers\PhotosController@delete');

Route::get('index/edit','App\Http\Controllers\PhotosController@edit')->middleware('App\Http\Middleware\UserMiddleware::class');

Route::post('index/update', 'App\Http\Controllers\PhotosController@update');

Route::get('index/download', 'App\Http\Controllers\PhotosController@download');

Route::post('index/comment', 'App\Http\Controllers\PhotosController@comment');

Route::get('like', 'App\Http\Controllers\LikeController@index');

Route::post('index/json/add', 'App\Http\Controllers\LikeController@add');

Route::post('index/json/get', 'App\Http\Controllers\LikeController@get');

Route::post('index/json/count', 'App\Http\Controllers\LikeController@count');
