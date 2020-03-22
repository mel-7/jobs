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

Route::get('/posts', 'PostController@postAPI')->name('posts');

Route::get('/category/list', 'CategoryController@categoryListAPI')->name('categorieslist');
Route::get('/category/tree', 'CategoryController@categoryTreeAPI')->name('categoriestree');

Route::group(['prefix'=>'admin','as'=>'admin.'], function(){
    Route::get('/post/edit/{id}', 'PostController@edit')->name('edit_post');
    Route::get('/users', 'UserController@usersAPI')->name('users');
});