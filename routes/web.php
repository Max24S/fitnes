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
    return ;
})->middleware('auth');

Route::get('/client','ClientController@main');

Auth::routes();
Route::name('admin.')
    ->namespace('Admin')
    ->prefix('admin')
    ->group(function () {
        Route::view('/','admin.index');
        Route::resource('user', 'UserController');
        Route::put("user/{user} ",'UserController@update');
    });
Route::get('/home', 'HomeController@index')->name('home');
