<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home/profile/{userid}', 'UserController@index')->name('profile');
Route::post('/home/profile/', 'UserController@addImage')->name('editprofile');
Route::get('/home/addpost', function () {
    return view('addpost');
})->name('addpost');
Route::get('/home/edit/post/{postid}', 'PostController@showEdit')->name('showingpost');
Route::post('/home/edit/post/{postid}', 'PostController@edit')->name('editingpost');
Route::post('/home/addpost', 'PostController@add')->name('addingpost');
Route::post('/home/deletepost', 'PostController@delete')->name('deletingpost');
Route::get('/home/post/{postid}', 'PostController@show')->name('postdetail');
Route::post('/addcomment', 'CommentsController@add')->name('comment');
Route::post('/addlike', 'LikesController@add')->name('addlike');
Route::post('/removelike', 'LikesController@remove')->name('removelike');
