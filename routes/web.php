<?php


Auth::routes();

Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@home')->name('home');
