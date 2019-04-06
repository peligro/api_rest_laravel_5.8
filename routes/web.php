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
    abort(404);
});
Route::post('api/v1/login', 'RestController@login')->name('login');
Route::resource('api/v1/categoria', 'CategoriaController');
Route::resource('api/v1/post', 'PostController');