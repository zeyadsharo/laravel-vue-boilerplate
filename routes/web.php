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
use App\Request;
use Carbon\Carbon;
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

Route::get('/home/{any}', 'API\requestCotroller@index')->where('any', '.*');
// Route::get('/create', function () {
// $user= User::findorfail(1);
// $request=Request::create(['created_at'=>Carbon::today()->toDateString(),'requestnumber'=>123132,
// 'department'=>'computer','location'=>'zakho','problem_description'=>'sdfdsfdsfdsf','priority'=>'sdfdsfd','completed_by'=>'zeyad
// Sharo','Remarks'=>'sdfdsfdsf','date_completed'=>Carbon::today()->toDateString()]);
// $user->requests()->save($request);
// });