<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class OrderController extends Controller
{
    public function store(Request $request)
    {

        $s3=\Storage::disk('s3');
        $s3->put('test,png',$_FILES,'public');
    }
}
