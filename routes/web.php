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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['register' => false]);;
Route::get('/', 'HomeController@index')->name('home');
Route::get('/', 'HomeController@index')->name('home');
Route::resource('/favourites', 'FavouriteController');

Route::resource('/admin','AdminController');
Route::resource('/user','UserController');

Route::get('logout', function () {
    Auth::logout();
    return Redirect::to('login');

});

//! books routes
Route::get('books/latest', 'BookController@getLatest')->name('books.latest');
Route::get('books/rate', 'BookController@getHighRated')->name('books.rate');
Route::resource('/books', 'BookController');
Route::resource('/comments', 'CommentController');
Route::resource('books.comments', 'CommentController');
