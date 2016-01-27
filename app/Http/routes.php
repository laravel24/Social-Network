<?php

Route::group(['middleware' => ['web']], function () {
/*
 * Home Routing
 */
Route::get('/', [
	'uses'=>'\App\Http\Controllers\HomeController@index',
	'as'=>'home'
]);

Route::resource('tasks', 'TasksController');
/*
 * Auth Routing
 */
Route::get('/signup', [
	'uses' => '\App\Http\Controllers\AuthController@getSignup',
	'as'   => 'auth.signup',
	'middleware' => ['guest']
]);
Route::post('/signup', [
	'uses' => '\App\Http\Controllers\AuthController@postSignup',
	'middleware' => ['guest']
]);
Route::get('/signin', [
	'uses' => '\App\Http\Controllers\AuthController@getSignin',
	'as'   => 'auth.signin',
	'middleware' => ['guest']
]);
Route::post('/signin', [
	'uses' => '\App\Http\Controllers\AuthController@postSignin',
	'middleware' => ['guest']
]);
Route::get('/signout', [
	'uses' => '\App\Http\Controllers\AuthController@getSignout',
	'as'   => 'auth.signout'
]);
/*
 * Search Routing
 */
Route::get('/search', [
	'uses'  => '\App\Http\Controllers\SearchController@getResults',
	'as'    => 'search.results'
]);
/*
 * User Profile
 */
Route::get('/user/{username}', [
	'uses'  => '\App\Http\Controllers\ProfileController@getProfile',
	'as'    => 'profile.index'
]);
Route::get('/profile/edit', [
	'uses'  => '\App\Http\Controllers\ProfileController@getEdit',
	'as'    => 'profile.edit',
	'middleware' => ['auth']
]);
Route::post('/profile/edit', [
	'uses'  => '\App\Http\Controllers\ProfileController@postEdit',
	'middleware' => ['auth']
]);
/*
 * Friend Routes
 */
Route::get('/friends', [
	'uses'  => '\App\Http\Controllers\FriendController@getIndex',
	'as'	=> 'friends.index',
	'middleware' => ['auth']
]);
});
