<?php


Auth::routes();

Route::get('/', 'HomeController@index');
Route::get('/tv', 'HomeController@tv');
Route::get('/movies', 'HomeController@movies');
Route::get('/home', 'HomeController@home')->name('home');
