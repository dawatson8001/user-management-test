<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('user.index');
});

Route::prefix('/user')->name('user')->group(function () {
    Route::get('s', 'UserController@index')->name('.index');
    Route::get('/add', 'UserController@create')->name('.create');
    Route::get('/edit/{userId}', 'UserController@update')->name('.update');
    Route::post('/store/{userId?}', 'UserController@store')->name('.store');
});
