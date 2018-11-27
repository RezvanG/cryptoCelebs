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

Route::get('/', 'DigitalCollectiblesController@index');
Route::get('/home', 'PagesController@index');
Route::get('/about', 'PagesController@about');
Route::get('/services', 'PagesController@services');
Route::get('/gallery', 'PagesController@gallery');
Route::get('/landing', function () {
    return view('crypto.landing');
});

Route::resource('peoples','PeoplesController');
Route::resource('posts','PostsController');
Route::get('digitalCollectibles/showAll','DigitalCollectiblesController@showAll');
Route::resource('digitalCollectibles','DigitalCollectiblesController');


/*Route::get('/users/{id}/{name}', function ($id, $name) {
    return 'This is user:'.$name. 'with an id of '.$id;
});

Route::get('/hello', function () {
    return '<h1>Hello World</h1>';
});

Route::get('/', function () {
    return view('welcome');
});*/
Auth::routes();

Route::get('/dashboard', 'DashboardController@index');
