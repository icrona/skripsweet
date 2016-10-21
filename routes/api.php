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
Route::post('getOrder',function(){
	$image=$request->file('image');
	$imageFileName = time() . '.' . $image->getClientOriginalExtension();

	$s3=\Storage::disk('s3');
	$filepath='/support-tickets'.$imageFileName;
    $s3->put($filepath,file_get_contents($image),'public');
});