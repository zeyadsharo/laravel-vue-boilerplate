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

use App\User;
Route::get('/', function () {
    return view('layouts.home');
});
  
 Route::get('auth/google', 'Auth\LoginController@redirectToGoogle');
  Route::get('auth/google/callback', 'Auth\LoginController@handleGoogleCallback');

Route::get('/mark-all-read/{user}', function (User $user) {
    $user->unreadNotifications->markAsRead();
    return response(['message'=>'done', 'notifications'=>$user->notifications]);
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Auth::routes();
Route::any('/admin/{any?}', 'AdminController@index')->where('any','.*')->middleware('auth');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');