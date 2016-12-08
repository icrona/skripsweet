@extends('admin')

@section('title', '| Admin Home')

@section('stylesheets')
<link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
    <style>
        h2{
            color:white;
        }
                            h3 {
                    text-align: right;
                    }
        table {
                    border-collapse: collapse;
                    width: 80%;
                }

                th, td {
                border: 1px solid #dddddd;
                text-align: left;
                padding: 8px;
                }
                                    tr:nth-child(even){
                        background-color:#dddddd;
                    }
                    tr:nth-child(odd){
                        background-color:rgba(255, 255, 255,1);
                    }

                th {
                background-color: #4CAF50;
                color: white;
                }
                a{
                        color:#df744a;
                    }
    </style>
@endsection

@section('content')

        <section class="text-center" id="inbox" style="background-color:#bfd8d2;">
        <div class="container" id="inbox">
                <h2>Inbox Orders</h2><br><br>

                <center><table >
                    <tr>
                        <th>Cake Name</th>
                        <th>Date Received</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    @foreach($orders as $order)
                    <tr>
                        <td>{{$order->cake_name}}</td>
                        <td>{{date('M j, Y',strtotime($order->created_at))}}</td> 
                        <td>{{$order->status}}</td>
                        <td>
                            <a href="order1.html">Details</a>
                            @if($order->status == "Waiting Confirmation")
                                <a href="#">Accept</a>
                                <a href="#">Decline</a>
                            @endif

                        </td>
                    </tr>
                    @endforeach
                </table></center>

                <br><br>
                <h3 style="text-align: center;"><a href={{url('orders')}}>More</a></h3>
            </div>
    </section>
@endsection
