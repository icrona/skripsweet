@extends('admin')

@section('title', '| Manage')

@section('stylesheets')
<link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
        <style>
        * {
          box-sizing: border-box;
        }

        #materialInput {
          background-image: url('/css/searchicon.png');
          background-position: 10px 10px;
          background-repeat: no-repeat;
          width: 60%;
          font-size: 16px;
          padding: 12px 20px 12px 40px;
          border: 1px solid #ddd;
          margin-bottom: 12px;
        }
        
        #material1Input {
          background-image: url('/css/searchicon.png');
          background-position: 10px 10px;
          background-repeat: no-repeat;
          width: 60%;
          font-size: 16px;
          padding: 12px 20px 12px 40px;
          border: 1px solid #ddd;
          margin-bottom: 12px;
        }

        section{
            background-color:#bfd8d2;
        }
        h2,h4{
            color:white;
        }
        
        h2{
            text-align:center;
        }
        table {
                        border-collapse: collapse;
                        width: 100%;
                    }

                    th, td {
                    
                    text-align: center;
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
                                #exTab1 .tab-content {
            
            background-color: #ffffff;
            
            padding : 5px 15px;
            border-radius: 5px 5px 5px 5px;
            }
    </style>
@endsection

@section('content')
<section id="materials" class="text-center">
        <div class="container">
            <h2>Manage</h2><br>
            <h5 style="color:red;text-align:right">*All base prices for 1 standard portion</h5>
        </div>
        <div class="row">
            <div class="col-md-4 offset-md-4">
                <a href="#" class="btn btn-success">Deploy changes to apps</a>
            </div>
        </div>
        <br>
        <div id="exTab1" class="container">
            <ul class="nav nav-pills nav-justified">
                <li class="active">
                    <a href="#1a" data-toggle="tab">Size</a>
                </li>
                <li>
                    <a href="#2a" data-toggle="tab">Flavour</a>
                </li>
                <li>
                    <a href="#3a" data-toggle="tab">Shape</a>
                </li>
                <li>
                    <a href="#4a" data-toggle="tab">Frosting & Colour</a>
                </li>
                <li>
                    <a href="#6a" data-toggle="tab">Pipe & Sprinkle</a>
                </li>
                <li>
                    <a href="#5a" data-toggle="tab">Decorations</a>
                </li>
                
            </ul>
            
            <div class="tab-content clearfix">
                <div class="tab-pane active" id="1a">
                    <div class="row">
                        <br><a href="newsize.html" class="btn btn-primary">Add Size </a><br><br>
                    </div>
                    <table id="size" class="display">
                    <tr>
                        <th style="text-align:center">No.</th>
                        <th style="text-align:center">Size</th>
                        <th style="text-align:center">Price Rate</th>
                        <th style="text-align:center">Action</th>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>15 cm</td>
                        <td>0.5</td>
                        <td>
                                <a href="editsize.html">Edit</a>
                                <a href="#delete" data-toggle="modal">Delete</a>
                        </td>
                        
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>18 cm</td>
                        <td>0.75</td>
<td>
                                <a href="editsize.html">Edit</a>
                                <a href="#delete" data-toggle="modal">Delete</a>
                        </td>
                        
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>20 cm</td>
                        <td>1</td>
<td>
                                <a href="editsize.html">Edit</a>
                                <a href="#delete" data-toggle="modal">Delete</a>
                        </td>
                        
                    </tr>
                        
                    </tr>
                </table>
                </div>
                <div class="tab-pane" id="2a">
                <div class="row">
                    <br><a href="newflavour.html" class="btn btn-primary" >Add Flavour </a> <br><br>
                    </div>
                    <table id="flavour" class="display">
                    <tr>
                        <th style="text-align:center">No.</th>
                        <th style="text-align:center">Flavour</th>
                        <th style="text-align:center">Price</th>
                        <th style="text-align:center">Action</th>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>Butter</td>
                        <td>10000</td>
<td>
                                <a href="editsize.html">Edit</a>
                                <a href="#delete" data-toggle="modal">Delete</a>
                        </td>
                        
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Chocolate</td>
                        <td>20000</td>
<td>
                                <a href="editsize.html">Edit</a>
                                <a href="#delete" data-toggle="modal">Delete</a>
                        </td>
                        
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Strawberry</td>
                        <td>30000</td>
<td>
                                <a href="editsize.html">Edit</a>
                                <a href="#delete" data-toggle="modal">Delete</a>
                        </td>
                        
                    </tr>

                </table>
                </div>
                <div class="tab-pane" id="3a">
                
                    <table id="shape" class="display">
                    <br><br>
                    <tr>
                        <th style="text-align:center">No.</th>
                        <th style="text-align:center">Shape</th>
                        <th style="text-align:center">Availability</th>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>Round</td>
                        <td>
                        <input type="checkbox" value="round">
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Square</td>
                        <td><input type="checkbox" value="square"></td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Heart</td>
                        <td><input type="checkbox" value="heart"></td>
                    </tr>
                </table>
                </div>
                
                <div class="tab-pane" id="4a">
                    <br><br>
                    <table id="colour" class="display">
                    <tr>
                        <th style="text-align:center">Frosting | Color %</th>
                        <th style="text-align:center">1% - 25%</th>
                        <th style="text-align:center">26% - 50%</th>
                        <th style="text-align:center">51% - 75%</th>
                        <th style="text-align:center">76% - 100%</th>
                        <th style="text-align:center">Action</th>
                        <th style="text-align:center">Display</th>
                    </tr>
                    <tr>
                        <th>Buttercream</th>
                        <td>12500</td>
                        <td>15000</td>
                        <td>17500</td>
                        <td>20000</td>
                        <td><a href="editcolour.html">Edit</a></td>
                        <td><input type="checkbox" value="buttercream"></td>
                        
                    </tr>
                    <tr>
                        <th>Icing</th>
                        <td>22500</td>
                        <td>25000</td>
                        <td>27500</td>
                        <td>30000</td>
                        <td><a href="editcolour.html">Edit</a></td>
                        <td><input type="checkbox" value="icing"></td>
                    </tr>
                    <tr>
                        <th>Ganache</th>
                        <td colspan="4">30000</td>
                        <td><a href="editcolour.html">Edit</a></td>
                        <td><input type="checkbox" value="ganache"></td>
                        
                    </tr>
                </table>
                </div>

                <div class="tab-pane" id="5a">
                    <div class="row" align="center">
                        <div>
                        <br><input type="text" id="materialInput" onkeyup="myFunction()" placeholder="Search for materials..">
                        <br><a href="newdecor.html" class="btn btn-primary">Add New Decoration </a> <br><br>
                        </div>                
                    </div>
                    <div class="row" id="d1">
                        <div class="col-md-3 portfolio-item">
                            <img class="img-responsive img-thumbnail" src="http://placehold.it/750x450" alt="">
                            <b>Car</b> <br> Rp. 20000 <br><br>
                            <a href="editdecor.html" class="btn btn-primary btn btn-sm" >Edit</a> 
                            <a href="#delete" class="btn btn-danger btn btn-sm""  data-toggle="modal">Delete</a>
                            <div class="checkbox">
                                <label><input type="checkbox" value="">Availability</label>
                            </div>
                            <br>
                        </div>

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
                        
                    </div>
                    <br><br>
 
                    
                </div>
                
                <div class="tab-pane" id="6a">
                    <div class="row" align="center">
                            <br>
                             <form>
                                <div class="form-group">
                                  <label for="sel2" align="center">Types:</label>
                                  <select name="formb" onchange="location = this.value;">
                                    <option value="#pipe-top">Pipe Top</option>
                                    <option value="#pipe-edge-bottom">Pipe Edge & Bottom</option>
                                    <option value="#sprinkles">Sprinkles</option>
                                  </select>                                
                                </div>
                              </form>
                    </div>                   
                    <div class="row" id="pipe-top">
                    <h3>Pipe Top</h3><br>
                        <div class="col-md-2 portfolio-item">
                            <img class="img-responsive img-thumbnail" src="http://placehold.it/750x450" alt="">
                            <b>Strawberry</b> <br> Rp. 35.000 <br><br>
                            <a href="editsprinkle.html" class="btn btn-primary btn btn-sm">Edit</a>
                            <div class="checkbox">
                                <label><input type="checkbox" value="">Availability</label>
                            </div>
                        </div>
                        
                        
                    </div>
                    
                    <br><br>
                    
                    <div class="row" id="pipe-edge-bottom">
                    <h3>Pipe Edge & Bottom</h3><br>
                        <div class="col-md-2 portfolio-item">
                            <img class="img-responsive img-thumbnail" src="http://placehold.it/750x450" alt="">
                            <b>Pipe 1</b> <br> Rp. 10000 <br><br>
                            <a href="editsprinkle.html" class="btn btn-primary btn btn-sm">Edit</a>
                            <div class="checkbox">
                                <label><input type="checkbox" value="">Availability</label>
                            </div>
                        </div>
                        
                                              
                    </div>
                    <br><br>
                    
                    <div class="row" id="sprinkles">
                    <h3>Sprinkles</h3><br>
                        <div class="col-md-2 portfolio-item">
                            <img class="img-responsive img-thumbnail" src="http://placehold.it/750x450" alt="">
                            <b>Meses</b> <br> Rp. 5000 <br><br>
                            <a href="editsprinkle.html" class="btn btn-primary btn btn-sm">Edit</a>
                            <div class="checkbox">
                                <label><input type="checkbox" value="">Availability</label>
                            </div>
                        </div>
                        <div class="col-md-2 portfolio-item">
                            <img class="img-responsive img-thumbnail" src="http://placehold.it/750x450" alt="">
                            <b>Butiran</b> <br> Rp. 5000 <br><br>
                            <a href="editsprinkle.html" class="btn btn-primary btn btn-sm">Edit</a>
                            <div class="checkbox">
                                <label><input type="checkbox" value="">Availability</label>
                            </div>
                        </div>
                    </div>
                    
                </div>
                
            </div>
        </div>
    </section>
                
@endsection
