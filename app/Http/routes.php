<?php

Route::get('/', [
    'uses' => '\Lago\Http\Controllers\HomeController@index',
    'as' => 'home',
]);


