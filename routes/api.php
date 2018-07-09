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
    Route::get('/headerLinks', 'ApiController@headerLinks');
    Route::get('/on-the-air', 'ApiController@onTheAir');
    Route::get('/airing-today', 'ApiController@airingToday');
    Route::get('/popular', 'ApiController@popular');
    Route::get('/top-rated', 'ApiController@topRated');
});
