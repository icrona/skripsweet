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

Route::get('/gallery',['as'=>'gallery.index','uses'=>'GalleryController@index']);
Route::get('/gallery/{gallery}',['as'=>'gallery.show','uses'=>'GalleryController@show']);
Route::post('/gallery/{gallery}',['as'=>'gallery.order','uses'=>'GalleryController@order']);


Route::get('/home', 'AdminController@home');
Route::get('/orders', 'AdminController@orders');
Route::get('/orders{id}',['as'=>'orders.details','uses'=>'AdminController@details']);
Route::get('/orders{id}/{status}',['as'=>'orders.status','uses'=>'AdminController@status']);
Route::get('/orderdownloadpdf{id}',array('as'=>'pdfdetails','uses'=>'AdminController@pdfdetails'));

Route::get('/report', 'AdminController@report');
Route::get('/manage','AdminController@manage');

Route::get('/signatures','CakeController@index');

Route::get('/settings',['as'=>'settings','uses'=>'SettingController@index']);

Route::put('/settings',['as'=>'settings.profile','uses'=>'SettingController@profile']);
Route::post('/settings/password',['as'=>'settings.password','uses'=>'SettingController@changePassword']);

Route::get('/logout', 'Auth\LoginController@logout');

Auth::routes();
