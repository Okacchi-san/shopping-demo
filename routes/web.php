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

Route::get('/home', 'HomeController@index');

//logout
Route::get('logout', 'Auth\LoginController@logout')->name('logout.get');
//sinup
Route::get('signup', 'Auth\RegisterController@showRegistrationForm')->name('signup.get');
Route::post('signup', 'Auth\RegisterController@register')->name('signup.post');

Route::get('product','ProductController@index')->name('product.get');
//session
Route::get('product/session','ProductController@store')->name('session.get');
Route::post('product/session','ProductController@ses_push');
Route::put('product/session','ProductController@update')->name('session.update');
Route::delete('product/session','ProductController@destroy')->name('session.delete');

// Auth
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('login.post');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
//Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
//Route::post('register', 'Auth\RegisterController@register');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

// stripe
Route::post('document/download', 'ChargeController@charge')->name('charge.post');


// download
Route::get('document/download', 'DownloadController@index')->name('download.get');

// admin
Route::get('admin/login', 'Admin\Auth\LoginController@showAdminLoginForm')->name('admin_login');
Route::post('admin/login', 'Admin\Auth\LoginController@login')->name('admin_login_post');
Route::get('/admin/home', 'Admin\HomeController@index')->name('admin_home');

Route::group(['prefix' => 'admin', 'middleware' => 'auth:admin'], function() {    
    //Route::post('logout', 'Admin\Auth\LoginController@logout')->name('admin_logout');
    Route::get('logout', 'Admin\Auth\LoginController@logout')->name('admin_logout_get');
    
    // Registration Routes...
    Route::get('register', 'Admin\Auth\RegisterController@showRegistrationForm')->name('admin_register');
    Route::post('register', 'Admin\Auth\RegisterController@register')->name('admin_register_post');

    // Password Reset Routes...
    //Route::get('password/reset', 'Admin\Auth\ForgotPasswordController@showLinkRequestForm')->name('admin_password_request');
    //Route::post('password/email', 'Admin\Auth\ForgotPasswordController@sendResetLinkEmail')->name('admin_password_email');
    //Route::get('password/reset/{token}', 'Admin\Auth\ResetPasswordController@showResetForm')->name('password.reset');
    //Route::post('password/reset', 'Admin\Auth\ResetPasswordController@reset');

    Route::get('product','Admin\ProductController@index')->name('admin_product.get');
    //商品情報登録・更新・削除
    Route::get('product/create','Admin\ProductController@create')->name('product.create');
    Route::post('product/store','Admin\ProductController@adminStore')->name('product.store');
    Route::get('product/edit','Admin\ProductController@adminEdit')->name('product.edit');
    Route::put('product/update','Admin\ProductController@adminUpdate')->name('product.update');
    Route::delete('product','Admin\ProductController@adminDestroy')->name('admin_product.delete');
    
    //session
    Route::get('product/session','Admin\ProductController@store')->name('admin_session.get');
    Route::post('product/session','Admin\ProductController@ses_push');
    Route::put('product/session','Admin\ProductController@update')->name('admin_session.update');
    Route::delete('product/session','Admin\ProductController@destroy')->name('admin_session.delete');
    
    //会員一覧
    Route::get('users','Admin\UserController@index')->name('admin_user.get');
    Route::delete('users','Admin\UserController@destroy')->name('admin_user.delete');
});


