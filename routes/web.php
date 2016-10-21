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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');
Route::post('getOrder',function(Request $request){
	$image=$request->file('image');
	$imageFileName = time() . '.' . $image->getClientOriginalExtension();

	$s3=\Storage::disk('s3');
	$filepath='/support-tickets'.$imageFileName;
    $s3->put($filepath,file_get_contents($image),'public');
});