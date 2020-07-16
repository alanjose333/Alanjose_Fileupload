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


Auth::routes();
Route::get('/', 'WelcomeController@index');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/admin', 'AdminController@index')->name('admin');
Route::get('/upload_file', 'WelcomeController@upload_file')->name('Upload File');
Route::post('/submit_file', 'WelcomeController@submit_file')->name('Submit File');
Route::get('/list_files', 'WelcomeController@list_files')->name('List Files');
Route::post('/delete_item', 'WelcomeController@delete_file')->name('Delete File');