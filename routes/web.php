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


Route::resource('threads','ThreadController')->except('show','destroy');

Route::delete('threads/{channel}/{thread}','ThreadController@destroy')->name('threads.destroy');

Route::get('threads/{channel}/{thread}','ThreadController@show')->name('threads.show');

Route::post('threads/{thread}/replies','ReplyController@store')->name('replies.store');

Route::resource('channels','ChannelController');

Route::post('replies/{reply}/favorites','FavoriteController@store');

Route::resource('profiles','ProfileController');
