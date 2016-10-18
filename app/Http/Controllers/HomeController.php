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
    public function index()
    {  
        //send to aws
        /*
        $s3=\Storage::disk('s3');
        $s3->put('myFile.txt','This is a dummy file with some content','public');
        */
        //get url from aws
        /*
        $url = Storage::disk('s3')->url('cakeTexture.png');
        */

        //return view('home')->withUrl($url);
        return view('home');
    }
}
