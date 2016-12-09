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
                <center>
                <table class="display">
                    <tr>
                        <th>Cake Name</th>
                        <th>Date Received</th>
                        <th>Deadline</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    <tr v-for="order in orders">
                        <td>@{{order.cake_name}}</td>
                        <td>@{{order.created_at}}</td>
                        <td>@{{order.date}}</td>
                        <td>@{{order.status}}</td>
                        <td>
                                <a href={{url('/orders/')}}@{{order.id}}>Details</a>
                                <span v-if="checkStatus(order.status)">
                                    <a @click.prevent=updateStatus("Accepted",order) href="#">Accept</a>
                                    <a @click.prevent=updateStatus("Declined",order) href="#">Decline</a>
                                </span>
                        </td>       
                    </tr>
                </table>
                </center>

                <br><br>
                <h3 style="text-align: center;"><a href={{url('orders')}}>More</a></h3>
            </div>
    </section>
@endsection
