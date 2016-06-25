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
]);

Route::post('/signup', [
    'uses' => '\Lago\Http\Controllers\AuthController@postSignup',
]);



