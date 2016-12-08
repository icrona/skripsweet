<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Order;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function home()
    {  
        $orders=Order::latest()->take(5)->get();
        return view('admin.home')->withOrders($orders);
    } 

    public function orders(){
    	return view('admin.orders')->withOrders($orders);
    }

    public function report(){
    	return view('admin.report');
    }
}

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