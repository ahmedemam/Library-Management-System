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
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookController;


Route::get("admin/routes", "HomeController@admin")->middleware("admin");
Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['register' => false]);
Route::get('/user/profile', 'AdminController@userProfile');
Route::get('/user/profileUpdate/', 'AdminController@updateProfile');
Route::get('/', 'HomeController@index')->name('home');
Route::get('/', 'HomeController@index')->name('home');
Route::resource('/favourites', 'FavouriteController');
Route::resource('/admin', 'AdminController');
Route::resource('/user', 'AdminController');
Route::get('logout', function () {
    Auth::logout();
    return Redirect::to('login');
});

Route::get('/home', 'HomeController@index')->name('home');
Route::get('admin/', 'HomeController@admin')->middleware('admin');
Route::get('/category/create', 'CategoryController@create');
Route::get('/category', 'CategoryController@index');
Route::post('/category/update', 'CategoryController@update');
Route::resource('/category', 'CategoryController');
Route::get('/category/create', 'CategoryController@create');
Route::get('/category/getall/{id}', 'CategoryController@getallbooks');
Route::get('/category', 'CategoryController@index');
Route::post('/category/update', 'CategoryController@update');
Route::resource('/category', 'CategoryController');
//! books routes
Route::post('books/search', 'BookController@search')->name('books.search');
Route::get('books/latest', 'BookController@getLatest')->name('books.latest');
Route::get('books/rate', 'BookController@getHighRated')->name('books.rate');
Route::get('/books/lease', 'CategoryController@getAllLeased');

Route::resource('/books', 'BookController');

Route::get('/books/lease/{id}/{user_id}', 'CategoryController@leasebooks');
Route::get('/books/{id}', 'CommentController@index');
//Route::resource('/books/{id}/comments', 'CommentController@store');
Route::resource('/comments', 'CommentController');