<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('test', 'TrendController@test');
Route::get('home', 'TrendController@home');
Route::get('explore/{query}', 'TrendController@explore');
Route::POST('tweet', 'TrendController@tweet');



// Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

// Route::prefix('auth')->group(function () {
//     Route::get('twitter', 'AuthController@login');
//     Route::get('twitter/callback', 'AuthController@callback');
// });
