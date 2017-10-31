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


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'MainController@index');
Route::get('/apply', 'MainController@apply');
Route::get('/contact', 'MainController@contact');
Route::get('/about', 'MainController@about');
Route::get('publish/{id}', 'MainController@view')->where('id', '[0-9]+');

Route::group(['middleware' => ['auth','Admin']], function () {
	Route::resource('competitions', 'CompetitionController');
	Route::resource('categories', 'CategoriesController');
	Route::resource('media', 'MediaController');
});

Route::group(['middleware' => ['auth']], function () {
	Route::post('/upload','MediaController@upload');
	Route::get('/upload','MediaController@upload');
	Route::get('/publish','MainController@publish');
	Route::post('/publish-store','MainController@publishStore');
	Route::get('/published-media','MainController@publishedMedia');
	Route::post('/like','MainController@likeDislike');

	
});
