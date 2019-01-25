<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('tv')->group(function () {
    Route::get('/headerLinks', 'ApiController@tv_headerLinks');
    Route::get('/on-the-air', 'ApiController@tv_onTheAir');
    Route::get('/airing-today', 'ApiController@tv_airingToday');
    Route::get('/popular', 'ApiController@tv_popular');
    Route::get('/top-rated', 'ApiController@tv_topRated');
    Route::get('/search', 'ApiController@tv_search');
});

Route::prefix('movies')->group(function () {
    Route::get('/headerLinks', 'ApiController@movie_headerLinks');
    Route::get('/now-playing', 'ApiController@movie_nowPlaying');
    Route::get('/upcoming', 'ApiController@movie_upcoming');
    Route::get('/popular', 'ApiController@movie_popular');
    Route::get('/top-rated', 'ApiController@movie_topRated');
});

Route::get('/lists/{list}', 'ApiController@list');
