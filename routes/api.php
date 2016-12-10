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

Route::get('/settings',['as'=>'settings.getProfile','uses'=>'SettingController@getProfile']);
Route::post('/settings/logo','SettingController@uploadLogo');
Route::put('/settings',['as'=>'settings.updateProfile','uses'=>'SettingController@updateProfile']);
Route::post('/settings/checkPassword',['as'=>'settings.check','uses'=>'SettingController@checkPassword']);
Route::post('/settings/changePassword',['as'=>'settings.change','uses'=>'SettingController@changePassword']);

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

Route::get('report','OrderController@getInitial');
Route::post('report','OrderController@filterReport');

Route::get('cake/birthday/search','CakeController@birthdaySearch');
Route::get('cake/anniversary/search','CakeController@anniversarySearch');
Route::get('cake/seasonal/search','CakeController@seasonalSearch');

Route::get('manage/flavour','ManageController@showFlavour');
Route::post('manage/flavour','ManageController@addFlavour');
Route::put('manage/flavour{id}','ManageController@editFlavour');
Route::delete('manage/flavour{id}','ManageController@deleteFlavour');

Route::get('manage/size','ManageController@showSize');
Route::post('manage/size','ManageController@addSize');
Route::put('manage/size{id}','ManageController@editSize');
Route::delete('manage/size{id}','ManageController@deleteSize');

Route::get('manage/shape','ManageController@showShape');
Route::put('manage/shape{id}','ManageController@editShape');

Route::get('manage/frosting','ManageController@showFrosting');
Route::put('manage/frosting{id}','ManageController@editFrosting');




