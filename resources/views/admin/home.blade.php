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
        <div class="container">
                <h2>Inbox Orders</h2><br><br>

                <center><table >
                    <tr>
                        <th>Cake Name</th>
                        <th>Customer</th>
                        <th>Date Received</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    <tr bgcolor="#f2f2f2">
                        <td>Jillian Cake</td>
                        <td>Jill</td>
                        <td>29/09/16</td> 
                        <td>Waiting Confirmation</td>
                        <td>
                                <a href="order1.html">Details</a>
                                <a href="#">Accept</a>
                                <a href="#">Decline</a>
                        </td>
                    </tr>
                    <tr>
                        <td>Jullian Cake</td>
                        <td>Prince</td>
                        <td>25/09/16</td>
                        <td>Accepted</td>
                        <td><a href="order1.html">Details</a></td>
                    </tr>
                    <tr>
                        <td>Madam Cake</td>
                        <td>Mom</td>
                        <td>20/09/16</td> 
                        <td>Declined</td>
                        <td><a href="order1.html">Details</a></td>
                    </tr>

                                        <tr>
                        <td>Jullian Cake</td>
                        <td>Prince</td>
                        <td>25/09/16</td>
                        <td>Accepted</td>
                        <td><a href="order1.html">Details</a></td>
                    </tr>
                    <tr>
                        <td>Madam Cake</td>
                        <td>Mom</td>
                        <td>20/09/16</td> 
                        <td>Declined</td>
                        <td><a href="order1.html">Details</a></td>
                    </tr>
                </table></center>

                <br><br>
                <h3 style="text-align: center;"><a href={{url('orders')}}>More</a></h3>
            </div>
    </section>
@endsection
