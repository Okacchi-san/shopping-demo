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

Auth::routes();

Route::get('/home', 'HomeController@index');
//Route::get('/home', 'HomeController@getData');
//login
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('login.post');
//logout
Route::get('logout', 'Auth\LoginController@logout')->name('logout.get');
//sinup
Route::get('signup', 'Auth\RegisterController@showRegistrationForm')->name('signup.get');
Route::post('signup', 'Auth\RegisterController@register')->name('signup.post');

Route::get('product','ProductController@index')->name('product.get');

Route::get('product/session','ProductController@indexSession');
//session
//Route::get('product/session','ProductController@ses_get');
Route::post('product/session','ProductController@ses_put');
