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
Route::get('/dashboard', 'Admin\DashboardController@index')->name('admin.dashboard.index');
Route::post('/sendEmail', 'Admin\DashboardController@sendEmail');
Route::post('/updateStatus/:id/:status', 'Admin\DashboardController@updateStatus');
Route::get('/users/', 'Admin\UsersController@index');
Route::get('/update/:id', 'Admin\UsersController@udpate');

// api Routes 