<?php

/*
 * Home
 */

Route::get('/', [
    'uses' => '\Lago\Http\Controllers\HomeController@index',
    'as' => 'home',
]);

/*
 * Authentication
 */

Route::get('/signup', [
    'uses' => '\Lago\Http\Controllers\AuthController@getSignup',
    'as' => 'auth.signup',
    'middleware' => ['guest'], // if user is authenticated then don't allow this route, 'guest' comes from app/Kernel.php $routeMiddleware array
]);

Route::post('/signup', [
    'uses' => '\Lago\Http\Controllers\AuthController@postSignup',
    'middleware' => ['guest'],
]);

Route::get('/signin', [
    'uses' => '\Lago\Http\Controllers\AuthController@getSignin',
    'as' => 'auth.signin',
    'middleware' => ['guest'],
]);

Route::post('/signin', [
    'uses' => '\Lago\Http\Controllers\AuthController@postSignin',
    'middleware' => ['guest'],
]);

Route::get('/signout', [
    'uses' => '\Lago\Http\Controllers\AuthController@Signout',
    'as' => 'auth.Signout',
]);

/*
 * Search
 */

Route::get('/search', [
    'uses' => '\Lago\Http\Controllers\SearchController@getResults',
    'as' => 'search.results',
    'middleware' => ['auth'],
]);

/*
 * User profile
 */

// pass in {username} to route
Route::get('/user/{username}', [
    'uses' => '\Lago\Http\Controllers\ProfileController@getProfile',
    'as' => 'profile.index',
    'middleware' => ['auth'],
]);

Route::get('/profile/edit', [
    'uses' => '\Lago\Http\Controllers\ProfileController@getEdit',
    'as' => 'profile.edit',
    'middleware' => ['auth'], // restrict this route to signed in users only
]);

Route::post('/profile/edit', [
    'uses' => '\Lago\Http\Controllers\ProfileController@postEdit',
    'middleware' => ['auth'],
]);

/*
 * Friends
 */
Route::get('/friends', [
    'uses' => '\Lago\Http\Controllers\FriendController@getIndex',
    'as' => 'friend.index',
    'middleware' => ['auth'], // restrict this route to signed in users only
]);

Route::get('/friends/add/{username}', [
    'uses' => '\Lago\Http\Controllers\FriendController@getAdd',
    'as' => 'friend.add',
    'middleware' => ['auth'], // restrict this route to signed in users only
]);

