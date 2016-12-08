<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Faq;
use App\Cake;
use App\Profile;
use App\User;

class LandingController extends Controller
{
    
	public function index(){
		return view('landing.faq');
	}
    
    public function getFaq()
    {
        $faqs = Faq::paginate(10);
        $response = [
          'pagination' => [
            'total' => $faqs->total(),
            'per_page' => $faqs->perPage(),
            'current_page' => $faqs->currentPage(),
            'last_page' => $faqs->lastPage(),
            'from' => $faqs->firstItem(),
            'to' => $faqs->lastItem()
          ],
          'data' => $faqs
        ];
        return response()->json($response);
    }

    public function searchFaq(Request $request){
      $search=$request->input('search');
      $faqs = Faq::where('question','like','%'.$search.'%')->paginate(10);
      $response = [
          'pagination' => [
            'total' => $faqs->total(),
            'per_page' => $faqs->perPage(),
            'current_page' => $faqs->currentPage(),
            'last_page' => $faqs->lastPage(),
            'from' => $faqs->firstItem(),
            'to' => $faqs->lastItem()
          ],
          'data' => $faqs
        ];
      return response()->json($response);

    }

    public function welcome(){
    	//with some faq and some cake
    	$faqs = Faq::all()->take(5);
      $cakes=Cake::orderByRaw('RAND()')->take(3)->get();
      $profile= Profile::find(1);
      $user=User::find(1);
      $email=$user->email;
    	return view('welcome')->withFaqs($faqs)->withCakes($cakes)->withProfile($profile)->withEmail($email);
    }

}
