<?php

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', function (Request $request) {
    $data = $request->validate([
        'email' => 'required|email',
        'password' => 'required'
    ]);

    $user = User::where('email', $request->email)->first();

    if (!$user || !Hash::check($request->password, $user->password)) {
        return response([
            'message' => ['These credentials do not match our records.']
        ], 404);
    }

    $token = $user->createToken('token_for-'.$user->id)->plainTextToken;

    $response = [
        'user' => $user,
        'token' => $token
    ];

    return response($response, 201);
});


// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });



Route::get('/posts', 'PostController@postAPI')->name('posts');

Route::get('/category/list', 'CategoryController@categoryListAPI')->name('categorieslist');
Route::get('/category/tree', 'CategoryController@categoryTreeAPI')->name('categoriestree');

Route::group(['prefix'=>'admin','as'=>'admin.'], function(){
    Route::get('/post/edit/{id}', 'PostController@edit')->name('edit_post');
    Route::get('/users', 'UserController@usersAPI')->name('users');
});
