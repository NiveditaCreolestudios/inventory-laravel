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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::POST('/Getinventory', 'CrudController@index');

Route::group(['prefix' => 'inventory', 'middleware'=>'auth'], function () {
    Route::post('/store', 'CrudController@store');
    Route::post('/update/{id}', 'CrudController@update');
    Route::get('/delete/{id}', 'CrudController@destroy');
});
