<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Cake;
use App\Profile;
use App\Order;
use Mail;
use App\User;
use Illuminate\Support\Facades\DB;
use Image;
use Storage;


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
        $order->order_from="Web";
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

    public function orderFromApps(Request $request){
        $this->validate($request,array(
            'name' => 'required|max:255',
            'phone' => 'required|max:255',
            'email' => 'required|max:255',
            'date' => 'required|max:255',
            'address' => 'required',
            ));

        $order= new Order;
        $order->name=$request->name;
        $order->phone=$request->phone;
        $order->email=$request->email;
        $order->date=$request->date;
        $order->address=$request->address;
        $order->notes=$request->notes;

        $order->cake_name=$request->cake_name;
        $order->cake_tier=$request->cake_tier;

        $order->cake_size=$request->cake_size;
        $order->cake_size1=$request->cake_size1;
        $order->cake_size2=$request->cake_size2;

        $order->cake_flavour=$request->cake_flavour;
        $order->cake_flavour1=$request->cake_flavour1;
        $order->cake_flavour2=$request->cake_flavour2;

        $order->cake_frosting=$request->cake_frosting;

        $order->cake_price=$request->cake_price;
        $order->status=$request->status;
        $order->order_from=$request->order_from;

        if($request->hasFile('image1')){
            $image1=$request->file('image1');
            $filename1='order/image1_'.time().'.'.$image1->getClientOriginalExtension();
            $location1=public_path('images/'.$filename1);
            Image::make($image1)->resize(345,420)->save($location1);
            $order->cake_image=$filename1;
        }
        if($request->hasFile('image2')){
            $image2=$request->file('image2');
            $filename2='order/image2_'.time().'.'.$image2->getClientOriginalExtension();
            $location2=public_path('images/'.$filename2);
            Image::make($image2)->resize(345,420)->save($location2);
            $order->cake_image1=$filename2;
        }
        if($request->hasFile('image3')){
            $image3=$request->file('image3');
            $filename3='order/image3_'.time().'.'.$image3->getClientOriginalExtension();
            $location3=public_path('images/'.$filename3);
            Image::make($image3)->resize(345,420)->save($location3);
            $order->cake_image2=$filename3;
        }
        if($request->hasFile('image4')){
            $image4=$request->file('image4');
            $filename4='order/image4_'.time().'.'.$image4->getClientOriginalExtension();
            $location4=public_path('images/'.$filename4);
            Image::make($image4)->resize(345,420)->save($location4);
            $order->cake_image3=$filename4;
        }

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

        $response = [
          'message' => 'success'
        ];
        return response()->json($response);


    }


        public function getSignature(){

        $birthday=DB::table('cakes')->select('name','description','size','price','image')->where('category','=','Birthday')->get();
        $anniversary=DB::table('cakes')->select('name','description','size','price','image')->where('category','=','Anniversary')->get();
        $seasonal=DB::table('cakes')->select('name','description','size','price','image')->where('category','=','Seasonal')->get();


        $response = [
          'birthday' => $birthday,
          'anniversary'    => $anniversary,
          'seasonal'   => $seasonal,
        ];
        return response()->json($response);
    }
}
