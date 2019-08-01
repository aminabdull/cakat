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



Route::post('/score', 'Score@post');
Route::get('/', 'GameController@getWord');
Route::get('/play', function () {
    return view('play');
});

Route::get('/getscore', function () {
    return view('home');
});

$router->get('/key', function () {
    return str_random(32);
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
