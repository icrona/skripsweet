@extends('admin')

@section('title', '| Orders')

@section('stylesheets')
<link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
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
                    section{
            background-color:#bfd8d2;
        }
        h2,h4{
            color:white;
        }
        .form-group {
                    width: 150px;
                    }
                    
        a{
                        color:#df744a;
                    }
    </style>
@endsection

@section('content')

        <section id="vieworder" class="text-center" >

            <div class="container"><center>
                <h2>Orders</h2><br>
                <form>
                    <div class="form-group">
                      <label for="sel1" align="center">Sort By :</label>
                      <select class="form-control" id="sel1">
                        <option>Status</option>
                        <option>Deadline</option>
                      </select>
                      
                    </div>
                  </form>
                
                
                <table id="ordertable" class="display">
                    <tr>
                        <th>No.</th>
                        <th>Image</th>
                        <th>Cake Name</th>
                        <th>Deadline</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td><img src="../startbootstrap-new-age-gh-pages/cake1.jpg" width="100"></td>
                        <td>Jillian Cake</td>
                        <td>02/10/16</td>
                        <td>Waiting Confirmation</td>
                        <td>
                                <a href="order1.html">Details</a>
                                <a href="#">Accept</a>
                                <a href="#">Decline</a>
                        </td>
                        
                    </tr>
                    <tr>
                        <td>2</td>
                        <td><img src="../startbootstrap-new-age-gh-pages/cake2.jpg" width="100"></td>
                        <td>Jullian Cake</td>
                        <td>28/09/16</td>
                        <td>Accepted</td>
                        <td><a href="order1.html">Details</a></td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td><img src="../startbootstrap-new-age-gh-pages/cake3.jpg" width="100"></td>
                        <td>Madam Cake</td>
                        <td>21/09/16</td>
                        <td>Declined</td>
                        <td><a href="order1.html">Details</a></td>
                    </tr>
                                        <tr>
                        <td>2</td>
                        <td><img src="../startbootstrap-new-age-gh-pages/cake2.jpg" width="100"></td>
                        <td>Jullian Cake</td>
                        <td>28/09/16</td>
                        <td>Accepted</td>
                        <td><a href="order1.html">Details</a></td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td><img src="../startbootstrap-new-age-gh-pages/cake3.jpg" width="100"></td>
                        <td>Madam Cake</td>
                        <td>21/09/16</td>
                        <td>Declined</td>
                        <td><a href="order1.html">Details</a></td>
                    </tr>
                </table>
                <center>
            </div>

            <br><br>
            <div class="row text-center">
                            <div class="col-lg-12">
                                <ul class="pagination">
                                    <li>
                                        <a href="#">&laquo;</a>
                                    </li>
                                    <li class="active">
                                        <a href="#">1</a>
                                    </li>
                                    <li>
                                        <a href="#">2</a>
                                    </li>
                                    <li>
                                        <a href="#">3</a>
                                    </li>
                                    <li>
                                        <a href="#">4</a>
                                    </li>
                                    <li>
                                        <a href="#">5</a>
                                    </li>
                                    <li>
                                        <a href="#">&raquo;</a>
                                    </li>
                                </ul>
                            </div>
                        </div>  
            
            
    </section>
@endsection
