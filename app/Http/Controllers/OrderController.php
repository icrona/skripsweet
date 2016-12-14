<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Response;
use Validator;
use Illuminate\Support\Facades\Input;
use App\Order;
use Carbon\Carbon;

class OrderController extends Controller
{

    public function showInbox()
    {
        $orders = Order::latest()->take(5)->paginate(5);
        $response = [
          'pagination' => [
            'total' => $orders->total(),
            'per_page' => $orders->perPage(),
            'current_page' => $orders->currentPage(),
            'last_page' => $orders->lastPage(),
            'from' => $orders->firstItem(),
            'to' => $orders->lastItem()
          ],
          'data' => $orders
        ];
        return response()->json($response);
    }

    public function showOrders()
    {
        $orders = Order::latest()->paginate(10);
        $response = [
          'pagination' => [
            'total' => $orders->total(),
            'per_page' => $orders->perPage(),
            'current_page' => $orders->currentPage(),
            'last_page' => $orders->lastPage(),
            'from' => $orders->firstItem(),
            'to' => $orders->lastItem()
          ],
          'data' => $orders
        ];
        return response()->json($response);
    }

    public function getInitial()
    {
        $from=Order::where('status','=','Accepted')->orderBy('date','asc')->first();
        $to=Order::where('status','=','Accepted')->orderBy('date','desc')->first();

        $first=$from->date;
        $last=$to->date;

        $first=Carbon::parse($first)->toDateString();
        $last=Carbon::parse($last)->toDateString();

        $response = [
          'first' => $first,
          'last' => $last,
        ];
        return response()->json($response);
    }

    public function filterReport(Request $request){
        $filter=$request->all();
        $from=$filter['from'];
        $to=$filter['to'];
        $orders = Order::where([
            ['status','=','Accepted'],
            ['date','>=',$from],
            ['date','<=',$to]    
        ])->orderBy('date','desc')->paginate(10);
        $total=$orders->sum('cake_price');

        $response = [
          'pagination' => [
            'total' => $orders->total(),
            'per_page' => $orders->perPage(),
            'current_page' => $orders->currentPage(),
            'last_page' => $orders->lastPage(),
            'from' => $orders->firstItem(),
            'to' => $orders->lastItem()
          ],
          'data' => $orders,
          'total' => $total
        ];
        return response()->json($response);
    }

    public function sortStatus()
    {
        $orders = Order::orderBy('status','desc')->paginate(10);
        $response = [
          'pagination' => [
            'total' => $orders->total(),
            'per_page' => $orders->perPage(),
            'current_page' => $orders->currentPage(),
            'last_page' => $orders->lastPage(),
            'from' => $orders->firstItem(),
            'to' => $orders->lastItem()
          ],
          'data' => $orders
        ];
        return response()->json($response);
    }

    public function sortDeadline()
    {
        $orders = Order::orderBy('date','asc')->paginate(10);
        $response = [
          'pagination' => [
            'total' => $orders->total(),
            'per_page' => $orders->perPage(),
            'current_page' => $orders->currentPage(),
            'last_page' => $orders->lastPage(),
            'from' => $orders->firstItem(),
            'to' => $orders->lastItem()
          ],
          'data' => $orders
        ];
        return response()->json($response);
    }

    public function showDetails($id){
        $order=Order::find($id);
        $response=[
            'data'=>$order
        ];
        return response()->json($response);
    }


    public function updateStatus(Request $request,$id)
    {
        $this->validate($request,array(
            'status'=>'required'
        ));
        $edit = Order::find($id)->update($request->all());
        return response()->json($edit);
    }

}