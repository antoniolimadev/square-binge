<?php


Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/movies', 'HomeController@movies');
Route::get('/home', 'HomeController@home');
Route::get('/lists', 'UserListsController@index');
Route::post('/lists', 'UserListsController@store');

Route::prefix('tv')->group(function () {
    Route::get('/', 'TvController@index')->name('television');
    Route::get('/search', 'TvController@search');
});

Route::prefix('movies')->group(function () {
    Route::get('/', 'MovieController@index')->name('movies');
    Route::get('/search', 'MovieController@search');
});

Route::prefix('user/{user}')->group(function () {
    Route::get('/', 'HomeController@profile');
    Route::get('/lists', 'UserListsController@lists');
    Route::get('/lists/{list}', 'UserListsController@list');
});
