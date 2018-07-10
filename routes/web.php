<?php


Auth::routes();

Route::get('/', 'HomeController@index');
Route::get('/movies', 'HomeController@movies');
Route::get('/home', 'HomeController@home')->name('home');

Route::prefix('tv')->group(function () {
    Route::get('/', 'TvController@index');
    Route::get('/search', 'TvController@search');
});
