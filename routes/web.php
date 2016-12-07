<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/',['as'=>'welcome','uses'=>'LandingController@welcome']);

Route::get('/#gallery', function () {
    return view('welcome#gallery');
});

Route::get('/#about_us', function () {
    return view('welcome#about_us');
});

Route::get('/#contact', function () {
    return view('welcome#contact');
});

Route::get('/#faq', function () {
    return view('welcome#faq');
});

Route::get('/#download', function () {
    return view('welcome#download');
});

Route::get('/faq',['as'=>'faq','uses'=>'LandingController@index']);

Route::get('/home', 'OrderController@home');
Route::get('/orders', 'OrderController@orders');
Route::get('/report', 'OrderController@report');

Route::get('/manage','ManageController@index');

Route::get('/signatures','CakeController@index');

Route::get('/settings',['as'=>'settings','uses'=>'SettingController@index']);

Route::put('/settings',['as'=>'settings.profile','uses'=>'SettingController@profile']);
Route::post('/settings/password',['as'=>'settings.password','uses'=>'SettingController@changePassword']);

Route::get('/logout', 'Auth\LoginController@logout');

Auth::routes();
