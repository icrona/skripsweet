<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Cake;

class GalleryController extends Controller
{
    public function index(){
    	$birthdays=Cake::where('category','=','birthday')->paginate(9);
    	$anniversarys=Cake::where('category','=','anniversary')->paginate(9);
    	$seasonals=Cake::where('category','=','seasonal')->paginate(9);
    	return view('landing.gallery')->withBirthdays($birthdays)->withAnniversarys($anniversarys)->withSeasonals($seasonals);
    }

    public function show($id){
    	$cake = Cake::find($id);
    	return view('landing.cake')->withCake($cake);
    }
}
