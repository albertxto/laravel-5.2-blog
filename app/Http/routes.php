<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::group(['middleware' => ['web']], function () {

    Route::get('/', function () {
        return view('welcome');
    });

    //Posts
    Route::get('/posts', 'PostController@index')->name('All Posts');
    Route::get('/posts/create', 'PostController@create')->name('Create Post');
    Route::post('/posts/store', 'PostController@store')->name('Store Post');
    Route::get('/posts/{post}', 'PostController@show')->name('Show Post');
    Route::get('/posts/edit/{post}', 'PostController@edit')->name('Edit Post');
    Route::put('/posts/update/{post}', 'PostController@update')->name('Update Post');
    Route::delete('/posts/destroy/{post}', 'PostController@destroy')->name('Delete Post');
    Route::get('/search', 'PostController@search')->name('Search Post');
});

Route::group(['middleware' => 'web'], function () {
    Route::auth();

    Route::get('/home', 'HomeController@index');

    Route::get('/user', 'UserController@edit');
    Route::put('/user/update', 'UserController@update');
});
