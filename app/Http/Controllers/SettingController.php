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

class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {  
    	$profile=Profile::find(1);
        return view('admin.settings')->withProfile($profile);
    }

    public function profile(Request $request){
    	$profile=Profile::find(1);
    	$this->validate($request,array(
            'name' => 'required|max:255',
            'phone'=>'required|numeric',
            'days' => 'required|integer',
            'bio' => 'required',
            'logo_image'=>'image'
        ));

        $profile->name=$request->input('name');
        $profile->phone=$request->input('phone');
        $profile->days=$request->input('days');
        $profile->bio=$request->input('bio');

        if($request->hasFile('logo_image')){
            $image=$request->file('logo_image');
            $filename='logo'.'.'.$image->getClientOriginalExtension();
            $location=public_path('images/logo/'.$filename);
            Image::make($image)->resize(400,400)->save($location);

        }
        $profile->save();

        $notification = array(
			'message' => 'Profile Save Changes Successfully', 
			'alert-type' => 'success'
		);

        return redirect()->route('settings')->with($notification);
    }


    public function changePassword(Request $request)
    {
        $request_data = $request->All();
        $current_password = Auth::User()->password;           
        if(Hash::check($request_data['current-password'], $current_password))
        {           
            $user_id = Auth::User()->id;                       
            $obj_user = User::find($user_id);
            $obj_user->password = Hash::make($request_data['password']);;
            $obj_user->save(); 
            $notification = array(
                'message' => 'Password Changes Successfully', 
                'alert-type' => 'success'
                );
            return redirect()->route('settings')->with($notification);
        }
        else
        {           
            $notification = array(
                'message' => 'Please enter correct current password', 
                'alert-type' => 'error'
                );
                return redirect()->route('settings')->with($notification);   
        }
    }         

}