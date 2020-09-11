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
    return view('layouts.home');
});

 Route::get('auth/google', 'Auth\LoginController@redirectToGoogle');
  Route::get('auth/google/callback', 'Auth\LoginController@handleGoogleCallback');
Auth::routes();
Route::get('/mark-all-read/{user}', function (User $user) {
    $user->unreadNotifications->markAsRead();
    return response(['message'=>'done', 'notifications'=>$user->notifications]);
});
 Route::get('/auth/redirect/{provider}', 'SocialController@redirect');
 Route::get('/callback/{provider}', 'SocialController@callback');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Auth::routes();
Route::any('/admin/{any?}', 'AdminController@index')->where('any','.*')->middleware('auth');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Auth::routes();
// Route::get('/home/{any}', 'API\HomeController@index')->where('any', '.*');
// Route::get('{any}/home', 'API\HomeController@index')->where('any', '.*');
// Route::get('{any}', 'API\HomeController@index')->where('any', '.*');
Route::get('{any}/requests', 'API\HomeController@index')->where('any', '.*');
Route::get('{any}/history', 'API\HomeController@index')->where('any', '.*');
Route::get('/googlelogin', 'SocialAuthGoogleController@redirect');
Route::get('/callback', 'SocialAuthGoogleController@callback');