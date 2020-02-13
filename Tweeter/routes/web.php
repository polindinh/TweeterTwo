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

Route::post('/tweets/addTweet', 'TweetsController@addTweet');
Route::get('/view/{id}', 'TweetsController@view');
Route::get('/edit/{id}', 'TweetsController@edit');
Route::post('/editTweet/{id}','TweetsController@editTweet');
Route::get('/delete/{id}','TweetsController@deleteTweet');
Route::get('/like/{id}','LikesController@like');
Route::get('/dislike/{id}','DislikesController@dislike');


Route::get('/comment/{id}','CommentsController@edit')->name('comments');
Route::post('/commentPost/{id}','CommentsController@commentPost');
Route::get('/viewComment/{id}','CommentsController@view');
Route::post('/editComment/{id}','CommentsController@editComment');
Route::get('/deleteComment/{id}','CommentsController@deleteComment');

Route::post('/follow/{id}', 'FollowsController@follow');
Route::post('/unfollow/{id}', 'FollowsController@unfollow');


Route::get('/profile/{id}','ProfilesController@showGuestProfile');
Route::post('/profile/{id}','ProfilesController@showProfile');
Route::post('/addProfile/{id}','ProfilesController@addProfile');
Route::post('/updateProfileForm/{id}','ProfilesController@updateForm');
Route::post('/updateProfile/{id}','ProfilesController@updateProfile');
Route::post('/deleteProfile/{id}','ProfilesController@deleteProfile');

Route::post('/search','SearchController@search')->name('search');
Route::get('/users','FollowsController@allUsers');
Route::get('/following/{id}','FollowsController@following')->name('following');
Route::get('/unfollow/{id}','FollowsController@unfollow')->name('unfollow');

// Route::post('/sfollowing/{id}','FollowsController@following')->name('sfollowing');
// Route::post('/sunfollow/{id}','FollowsController@unfollow')->name('sunfollow');















