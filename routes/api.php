<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/signin', 'UserController@Login');
Route::post('/signup', 'UserController@Register');
Route::get('/posts', 'PostsController@AllPosts');
Route::post('/addpost', 'PostsController@AddPost');
Route::post('/profile', 'UserController@GetAccount');
Route::get('/analytics', 'PostsController@Analytics');
