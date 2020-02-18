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

Route::post('/tweets/addTweet', 'TweetsController@addTweet')->middleware('auth');
Route::get('/view/{id}', 'TweetsController@view')->middleware('auth');
Route::get('/edit/{id}', 'TweetsController@edit')->middleware('auth');
Route::post('/editTweet/{id}','TweetsController@editTweet')->middleware('auth');
Route::get('/delete/{id}','TweetsController@deleteTweet')->middleware('auth');
Route::post('/like/{id}','LikesController@like')->middleware('auth');
Route::post('/unlike/{id}','LikesController@unlike')->middleware('auth');
Route::get('/dislike/{id}','DislikesController@dislike')->middleware('auth');


Route::get('/comment/{id}','CommentsController@edit')->name('comments')->middleware('auth');
Route::post('/commentPost/{id}','CommentsController@commentPost')->middleware('auth');
Route::get('/viewComment/{id}','CommentsController@view')->middleware('auth');
Route::post('/editComment/{id}','CommentsController@editComment')->middleware('auth');
Route::get('/deleteComment/{id}','CommentsController@deleteComment')->middleware('auth');

Route::get('/profile/{id}','ProfilesController@showGuestProfile')->middleware('auth');
Route::post('/profile/{id}','ProfilesController@showProfile')->middleware('auth');
Route::post('/addProfile/{id}','ProfilesController@addProfile')->middleware('auth');
Route::post('/updateProfileForm/{id}','ProfilesController@updateForm')->middleware('auth');
Route::post('/updateProfile/{id}','ProfilesController@updateProfile')->middleware('auth');
Route::post('/deleteProfile/{id}','ProfilesController@deleteProfile')->middleware('auth');

Route::get('/search','SearchController@search')->name('search')->middleware('auth');
Route::get('/users','FollowsController@allUsers')->middleware('auth');
Route::post('/following/{id}','FollowsController@following')->name('following')->middleware('auth');
Route::post('/unfollow/{id}','FollowsController@unfollow')->name('unfollow')->middleware('auth');

















