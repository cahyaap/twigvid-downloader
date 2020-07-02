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

Route::get('/', 'TwitigController@index');
Route::post('/download', 'TwitigController@download')->name('download');
Route::post('/download-video', 'TwitigController@downloadVideo')->name('download-video');