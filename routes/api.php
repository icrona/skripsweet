<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::get('/faqadmin/search', 'FaqController@searchFaq');
Route::resource('faqadmin','FaqController');

Route::get('/faquser/search','LandingController@searchFaq');
Route::get('/faquser','LandingController@getFaq');

Route::resource('cake','CakeController',['except'=>['index','show','create']]);
Route::get('cake/birthday','CakeController@birthday');
Route::get('cake/anniversary','CakeController@anniversary');
Route::get('cake/seasonal','CakeController@seasonal');

Route::post('cake/upload','CakeController@upload');
Route::post('cake/upload/edit{edit}','CakeController@uploadEdit');

Route::get('inbox','OrderController@showInbox');
Route::get('orders','OrderController@showOrders');
Route::get('details{id}','OrderController@showDetails');
Route::get('orders/status','OrderController@sortStatus');
Route::get('orders/deadline','OrderController@sortDeadline');
Route::put('orders{id}','OrderController@updateStatus');

Route::get('cake/birthday/search','CakeController@birthdaySearch');
Route::get('cake/anniversary/search','CakeController@anniversarySearch');
Route::get('cake/seasonal/search','CakeController@seasonalSearch');



