<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Cake;
use App\Profile;
use App\Order;
use Mail;
use App\User;

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
        $profile=Profile::find(1);
        $days=$profile->days;
    	return view('landing.cake')->withCake($cake)->withDays($days);
    }

    public function order(Request $request,$id){
        $this->validate($request,array(
            'name' => 'required|max:255',
            'phone' => 'required|max:255',
            'email' => 'required|max:255',
            'date' => 'required|max:255',
            'address' => 'required',
            ));

        $cake=Cake::find($id);
        $order= new Order;
        $order->name=$request->name;
        $order->phone=$request->phone;
        $order->email=$request->email;
        $order->date=$request->date;
        $order->address=$request->address;
        $order->notes=$request->notes;

        $order->cake_name=$cake->name;
        $order->cake_description=$cake->description;
        $order->cake_size=$cake->size;
        $order->cake_price=$cake->price;
        $order->cake_image=$cake->image;
        $order->status="Waiting Confirmation";
        $order->save();

        $user=User::find(1);
        $data=array(
            'email'=>$user->email,
            'subject'=>'Congratulations! You Got New Order!',
            'order_id'=>$order->id,
            'customer_name'=>$order->name,
            'customer_email'=>$order->email,
            'customer_phone'=>$order->phone,
            'delivery_date'=>$order->date,
            'cake_name'=>$order->cake_name,
            'cake_price'=>$order->cake_price,
            );
        Mail::send('email.order',$data,function($message) use($data){
            $message->from('skripsweetcake@gmail.com');
            $message->to($data['email']);
            $message->subject($data['subject']);
        });
        return redirect()->route('welcome');
    }
}
