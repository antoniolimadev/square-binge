<?php


Auth::routes();

Route::get('/', 'HomeController@index');
Route::get('/movies', 'HomeController@movies');
Route::get('/home', 'HomeController@home')->name('home');

Route::prefix('tv')->group(function () {
    Route::get('/', 'TvController@index');
    Route::get('/on-the-air', 'TvController@onTheAir');
    Route::get('/airing-today', 'TvController@airingToday');
    Route::get('/popular', 'TvController@popular');
    Route::get('/top-rated', 'TvController@topRated');
    // test
    Route::get('/test', 'TvController@test');
});
