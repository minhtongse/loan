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

Route::get('/', 'HomeController@index');

Auth::routes([
    'register' => false,
    'reset' => false,
    'verify' => false,
]);

Route::any('/home', 'HomeController@index')->name('home');
Route::any('/admin/{id?}', 'AdminController@index')->name('admin');
Route::any('/pay/{id}', 'HomeController@pay')->name('pay');