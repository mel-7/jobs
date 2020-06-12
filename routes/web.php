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
    return view('pages.home');
});

Auth::routes();

/**
 * Loggedin Users/Applicants
 */
Route::group(['prefix'=>'u','as'=>'user.'], function(){
    Route::get('/', 'ApplicantsController@account')->name('account');
    Route::get('/account', 'ApplicantsController@account')->name('account');
    Route::post('/update-account-info', 'ApplicantsController@updateAccountInfo')->name('update_account_info');
    Route::get('/get-account-info/{id}', 'ApplicantsController@getAccountInfo')->name('get_account_info');

    Route::get('/cv', 'ApplicantsController@cv')->name('cv');
    Route::get('/my-applications', 'ApplicantsController@myApplications')->name('myapplications');
    // Messages
    Route::get('/my-messages', 'MessageController@index')->name('my_messages');
    Route::get('/my-messages/conversation/{id}', 'MessageController@getMessagesFor');
    Route::post('/my-messages/conversation/send', 'MessageController@send');
    // Route::post('/my-messages/conversation/file', 'MessageController@sendFile');
    Route::get('/my-messages/contacts', 'MessageController@getContacts');
});
// Applicant Details
Route::get('/applicant/experience/{id}', 'ApplicantsController@getWorkExperience')->name('get_work_experience');
Route::post('/applicant/experience/update', 'ApplicantsController@update')->name('save_work_experience');
Route::post('/applicant/experience/new', 'ApplicantsController@store')->name('save_work_experience');
Route::delete('/applicant/experience/destroy/{id}', 'ApplicantsController@destroy')->name('delete_work_experience');

/**
 * Employer Routes
 */
Route::group(['prefix'=>'e','as'=>'employer.'], function(){
    Route::get('/jobs', 'EmployerController@jobs')->name('jobs');
    Route::get('/dashboard', 'EmployerController@dashboard')->name('dashboard');
    Route::get('/account-settings', 'EmployerController@accountSettings')->name('account_settings');
});

/**
 *
 * Admin Routes
 *
 */
Route::group(['prefix'=>'admin','as'=>'admin.'], function(){
    // ->middleware('can:accessAdminModel,user')
    Route::get('/', 'AdminController@dashboard')->name('dashboard');

    // Users
    Route::post('/user/store', 'UserController@store')->name('store_user');


    // Post
    Route::get('/post/create', 'PostController@create')->name('create_post');
    Route::post('/post/store', 'PostController@store')->name('store_post');
    Route::post('/post/update', 'PostController@update')->name('update_post');
    Route::delete('/post/destroy/{id}', 'PostController@destroy')->name('delete_post');
    // Route::get('/post/edit/{id}', 'PostController@edit')->name('edit_post');

    // Category
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

/**
 * Get Image
 */
Route::get('/conversation/files/{msgid}/{extn}/{filename}', 'FileController@show')->name('file.show');
