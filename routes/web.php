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
    return view('welcome');
});

Route::get('admin', 'DashboardController@index')->name('admin');

Route::get('admin/categories', 'CategoryController@index')->name('categories.index');
Route::get('admin/categories/create', 'CategoryController@create')->name('categories.create');
Route::post('admin/categories/store', 'CategoryController@store')->name('categories.store');
Route::get('admin/categories/{id}/show', 'CategoryController@show')->name('categories.show');
Route::get('admin/categories/{id}/edit', 'CategoryController@edit')->name('categories.edit');
Route::put('admin/categories/{id}/update', 'CategoryController@update')->name('categories.update');
Route::delete('admin/categories/{id}/destroy', 'CategoryController@destroy')->name('categories.destroy');

Route::resource('admin/products', 'ProductController');

