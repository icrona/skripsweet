<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Profile;
use Session;
use Image;
use Storage;
use Auth;
use Hash;
use App\User;
use Validator;
use Response;
use Log;
use Illuminate\Support\Facades\Input;


class SettingController extends Controller
{
    public function getProfile(){
        $profile=Profile::find(1);
        $response=[
            'data'=>$profile
        ];
        return response()->json($response);
    }

    public function uploadLogo(Request $request){
        $image=$request->file;
        $filename=time().'.'.$image->getClientOriginalExtension();
        $location=public_path('images/logo/'.$filename);
        Image::make($image)->resize(400,400)->save($location);

        return response()->json($filename);
    }

    public function updateProfile(Request $request){
    	
    	$this->validate($request,array(
            'name' => 'required|max:255',
            'phone'=>'required|numeric',
            'days' => 'required|integer',
            'bio' => 'required',
            'image'=>'required'
        ));
        
        $profile=Profile::find(1)->update($request->all());


        return response()->json($profile);
    }

    public function checkPassword(Request $request){
        $request_data = $request->all();
        $user=User::find(1);
        $current_password = $user->password;          
        if(Hash::check($request_data['current_password'], $current_password))
        {   
            $response=[
                'data'=>true
            ];                
        }
        else{
            $response=[
                'data'=>false
            ];
        }
        return response()->json($response);

    }
    public function changePassword(Request $request)
    {
        $request_data=$request->all();
        $new_password=$request_data['new_password'];

        $obj_user = User::find(1);                       
        $obj_user->password = Hash::make($new_password);;
        $obj_user->save();

        $response=[
            'message'=>'success'
        ];           
        return response()->json($response);;
    }

    public function profileSettings(){
        $profile=Profile::find(1);
        $min_days=$profile->days;
        $image=$profile->image;

        $response=[
            'min_days'=>$min_days,
            'image'=>$image
        ];

        return response()->json($response);
    }         

}