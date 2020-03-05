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
    return view('homepage');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

/**
 * 
 * Admin Routes
 * 
 */
Route::group(['prefix'=>'admin','as'=>'admin.'], function(){
    // ->middleware('can:accessAdminModel,user')
    Route::get('/', 'adminController@dashboard')->name('dashboard');
    Route::get('/posts', 'PostController@index')->name('posts');
    Route::get('/post/create', 'PostController@create')->name('create_post');
    Route::post('/post/store', 'PostController@store')->name('store_post');
    
    // Category Routes
    Route::get('/categories', 'CategoryController@index')->name('categories');

});