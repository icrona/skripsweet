@extends('admin')

@section('title', '| Report')

@section('stylesheets')
<link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
    <style>
                section{
            background-color:#bfd8d2;
        }
        h2,h4{
            color:white;
        }
        .form-group {
                    width: 150px;
                    }
    </style>
@endsection

@section('content')

        <section id="vieworder" class="text-center" >
        <div class="container"><center>
                <h2>Report</h2><br>
                <style>
                    
                </style>
                    
                      Period: <input type="date" name="field1" id="field1"/> - <input type="date" name="field2" id="field2"/> <a href="#" data-toggle="modal" class="btn btn-primary">OK</a> <a href="download.html" class="btn btn-link"><span class="glyphicon glyphicon-download-alt" aria-hidden="true"></span></a><br/><br/>
                    
                
                <style>
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
                </style>
                <table id="ordertable" class="display">
                    <tr>
                        <th>Delivery Date</th>
                        <th>Customer Name</th>
                        <th>Cake Name</th>
                        <th>Flavour</th>
                        <th>Price</th>
                    </tr>
                    <tr>
                        <td>02/10/2016</td>
                        <td>Jillian</td> 
                        <td>Jillian Cake</td>
                        <td>Chocolate</td>
                        <td>250000</td>
                        
                    </tr>
                    <tr>
                        <td>28/09/2016</td>
                        <td>Prince</td>
                        <td>Jullian Cake</td>
                        <td>Red Velvet</td>
                        <td>400000</td>
                    </tr>
                    <tr>
                        <td>21/09/2016</td>
                        <td>Mom</td>
                        <td>Madam Cake</td>
                        <td>Green Tea</td>
                        <td>200000</td>
                    </tr>
                </table>
                <center>
            </div>  
            
    </section>
@endsection
