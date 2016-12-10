<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Order;
use PDF;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function home(){
        return view('admin.home');
    }

    public function orders(){
        return view('admin.orders');
    }

    public function report(){
    	return view('admin.report');
    }

    public function manage()
    {  
        return view('admin.manage');
    } 
    public function details($id){
    	$order=Order::find($id);
    	return view('admin.details')->withOrder($order);
    }
    public function status($id,$status){
    	$order=Order::find($id);
    	$order->status=$status;
    	$order->save();
    	return view('admin.details')->withOrder($order);
    }

    public function pdfDetails(Request $request,$id){        
        if($request->has('download')){
            $order=Order::find($id);
            $time=Carbon::now();
            $order->time=$time;
            view()->share('order',$order);
            $pdf = PDF::loadView('pdf.details');
            return $pdf->download('order_details.pdf');
        }
    }

    public function pdfReport(Request $request){        
        if($request->has('download')){
            $from=$request->from;
            $to=$request->to;

            $reports = Order::where([
                ['status','=','Accepted'],
                ['date','>=',$from],
                ['date','<=',$to]    
            ])->latest()->get();

            $total_report=$reports->sum('cake_price');
            $time_report=Carbon::now();

            view()->share('reports',$reports);
            view()->share('total_report',$total_report);
            view()->share('time_report',$time_report);
            view()->share('from',$from);
            view()->share('to',$to);

            $pdf = PDF::loadView('pdf.report');
            return $pdf->download('report.pdf');
        }
    }

    public function settings()
    {  
        return view('admin.settings');
    }

}
