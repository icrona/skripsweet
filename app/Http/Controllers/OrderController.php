<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Response;
use Validator;
use Illuminate\Support\Facades\Input;
use App\Order;

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

    public function sortStatus()
    {
        $orders = Order::orderBy('status','desc')->paginate(5);
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
        $orders = Order::orderBy('date','asc')->paginate(5);
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
            'name' => 'required|max:255',
            'phone' => 'required|max:255',
            'email' => 'required|max:255',
            'date' => 'required|max:255',
            'address' => 'required',
            'cake_name' => 'required|max:255',
            'cake_description' => 'required',
            'cake_size'=>'required',
            'cake_price'=>'required',
            'cake_image'=>'required|max:255',
            'status'=>'required'
        ));
        $edit = Order::find($id)->update($request->all());
        return response()->json($edit);
    }

}