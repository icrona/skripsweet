<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Filesystem\Filesystem;
use Image;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function getUpload()
    {  
        if(isset($_FILES['file'])){
            $file=$_FILES['file'];

            $name=$file['name'];
            $tmp_name=$file['tmp_name'];

            $extension=explode('.', $name);
            $extension=strtolower(end($extension));

            $tmp_file_name="{$name}.{$extension}";

            $location=public_path('images/'.$tmp_file_name);
            Image::make($file)->resize(800,400)->save($location);
        }
    }
}
