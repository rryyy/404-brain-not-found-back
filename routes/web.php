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

Route::get('/posts', 'PostsController@index')->name('post.index');
Route::post('/posts', 'PostsController@store')->name('post.store');
Route::get('/posts/create', 'PostsController@create')->name('post.create');
Route::put('/posts/{post}', 'PostsController@update')->name('post.update');
