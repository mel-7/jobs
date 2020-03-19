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
    // Route::get('/dashboard', 'adminController@dashboard')->name('dashboard');
    // Route::get('/posts', 'PostController@index')->name('posts');
    Route::get('/post/create', 'PostController@create')->name('create_post');
    Route::post('/post/store', 'PostController@store')->name('store_post');
    Route::post('/post/update', 'PostController@update')->name('update_post');
    Route::delete('/post/destroy/{id}', 'PostController@destroy')->name('delete_post');
    // Route::get('/post/edit/{id}', 'PostController@edit')->name('edit_post');
    
    // Category Routes
    // Route::get('/post/categories', 'CategoryController@index')->name('categories');
    Route::post('/post/category/store', 'CategoryController@store')->name('addcategory');
    Route::post('/post/category/update', 'CategoryController@update')->name('updatecategory');
    Route::delete('/post/category/destroy/{id}', 'CategoryController@destroy')->name('destroycategory');

});


/**
 * Admin SPA Routes
 */
Route::group(['prefix'=>'admin','as'=>'admin.'], function(){
    Route::get('{any}', function () {
        return view('layouts.admin');
    })->where('any', '.*');
});