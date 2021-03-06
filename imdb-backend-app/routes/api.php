<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', 'AuthController@login');
    Route::post('register', 'AuthController@register');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');

});

Route::get('movies', 'MovieController@index');
Route::get('movies/search', 'MovieController@searchMovies');
Route::get('movies/filter', 'MovieController@filterMovies');
Route::get('movies/{id}', 'MovieController@show');
Route::post('movies/reaction', 'MovieReactionController@store')->middleware('auth:api');
Route::post('movies/comment', 'MovieCommentController@store')->middleware('auth:api');
Route::get('movies/comment/{id}', 'MovieCommentController@getCommentsByMovieId')->middleware('auth:api');
Route::put('movies/{id}/views', 'MovieController@updateMovieCount')->middleware('auth:api');
Route::get('genres', 'GenreController@index');