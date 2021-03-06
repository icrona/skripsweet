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
<section id="materials">
        <div id="deploy_changes">
          <div class="container" >
            <h2>Manage</h2><br>
            <h6 style="color:red;text-align:right">*All base prices for 1 standard portion</h6>
        </div>
        <div class="row" >
            <div class="col-md-4 text-center">
                <a href="#" @click.prevent="deploy()" class="btn btn-success">Deploy changes to apps</a><br>
                <small>Last Changes : @{{version}}</small>

            </div>
        </div>
        </div>
        
        <br>
        </div>

        <div id="exTab1" class="container">
        <div class=text-center>
            <ul class="nav nav-pills nav-justified">
                <li class="active">
                    <a href="#manage_flavour" data-toggle="tab">Flavour</a>
                </li>
                <li>
                    <a href="#manage_size" data-toggle="tab">Size</a>
                </li>
                <li>
                    <a href="#manage_shape" data-toggle="tab">Shape</a>
                </li>
                <li>
                    <a href="#manage_frosting" data-toggle="tab">Frosting & Colour</a>
                </li>
                <li>
                    <a href="#manage_pipe" data-toggle="tab">Pipe & Sprinkle</a>
                </li>
                <li>
                    <a href="#decorations" data-toggle="tab">Decorations</a>
                </li>
                
            </ul>
            </div>
            
            <div class="tab-content clearfix">
                <div class="tab-pane" id="manage_size">
                    <div class="row text-center">
                        <br><a data-toggle="modal" data-target="#create-item-size" class="btn btn-primary">Add Size </a><br><br>
                    </div>
                    <table id="size" class="display">
                    <tr>
                        <th style="text-align:center">No.</th>
                        <th style="text-align:center">Size</th>
                        <th style="text-align:center">Price Rate</th>
                        <th style="text-align:center">Action</th>
                    </tr>
                    <tr v-for="size in sizes">
                        <td>@{{sizes.indexOf(size)+1}}</td>
                        <td>@{{size.size}}</td>
                        <td>@{{size.rate}}</td>
                        <td>
                          <button class="edit-modal btn btn-info btn btn-sm" @click.prevent="editItem(size)">
                            <span class="glyphicon glyphicon-edit"></span> 
                          </button>
                          <button class="delete-btn delete-modal btn btn-danger btn btn-sm" @click.prevent="deleteItem(size)">
                            <span class="glyphicon glyphicon-trash"></span> 
                          </button>
                        </td>            
                    </tr>                     
                </table>
                <br>
                <nav class="text-center">
                    <ul class="pagination">
                      <li v-if="pagination.current_page > 1">
                        <a href="#" aria-label="Previous" @click.prevent="changePage(pagination.current_page - 1)">
                          <span aria-hidden="true">«</span>
                        </a>
                      </li>
                      <li v-for="page in pagesNumber" v-bind:class="[ page == isActived ? 'active' : '']">
                        <a href="#" @click.prevent="changePage(page)">
                          @{{ page }}
                        </a>
                      </li>
                      <li v-if="pagination.current_page < pagination.last_page">
                        <a href="#" aria-label="Next" @click.prevent="changePage(pagination.current_page + 1)">
                          <span aria-hidden="true">»</span>
                        </a>
                      </li>
                    </ul>
                  </nav>

                    <div class="modal fade" id="create-item-size"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
          <h3 class="modal-title" id="myModalLabel">Add New Size</h3>
        </div>
        <div class="modal-body">
          <form method="post" enctype="multipart/form-data" v-on:submit.prevent="createItem" data-parsley-validate="">
            <div class="form-group">
              <label for="name">Size (in cm) :</label>         
              <input type="text" name="name" class="form-control" v-model="newItem.size" required="" data-parsley-type="digits" /> 
              
            </div>
            <div class="form-group">
              <label for="price">Price Rate :</label>
              <input type="text" name="price" class="form-control" v-model="newItem.rate" required="" />            
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-success">Submit</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>


  <div class="modal fade" id="edit-size" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
        <h3 class="modal-title" id="myModalLabel">Edit Size</h3>
      </div>
      <div class="modal-body">
        <form method="post" enctype="multipart/form-data" v-on:submit.prevent="updateItem(fillItem.id)" data-parsley-validate="">
          <div class="form-group">
            <label for="size">Size (in cm):</label>
            <input type="text" name="size" class="form-control" v-model="fillItem.size" required="" data-parsley-type="digits" />
          </div>
          <div class="form-group">
            <label for="rate">Price Rate:</label>
            <input type="text" name="rate" class="form-control" v-model="fillItem.rate" required="" />
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-success">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div> 
</div>


                </div>


                <div class="tab-pane active" id="manage_flavour">
                <div class="row text-center">
                    <br><a data-toggle="modal" data-target="#create-item-flavour" class="btn btn-primary" >Add Flavour </a> <br><br>
                    </div>
                    <table id="flavour" class="display">
                    <tr>
                        <th style="text-align:center">No. </th>
                        <th style="text-align:center">Flavour</th>
                        <th style="text-align:center">Price</th>
                        <th style="text-align:center">Action</th>
                    </tr>
                    <tr v-for="flavour in flavours">
                        <td>@{{flavours.indexOf(flavour)+1}}</td>
                        <td>@{{flavour.name}}</td>
                        <td>@{{flavour.price}}</td>
                            <td>
                          <button class="edit-modal btn btn-info btn btn-sm" @click.prevent="editItem(flavour)">
                            <span class="glyphicon glyphicon-edit"></span> 
                          </button>
                          <button class="delete-btn delete-modal btn btn-danger btn btn-sm" @click.prevent="deleteItem(flavour)">
                            <span class="glyphicon glyphicon-trash"></span> 
                          </button>
                        </td>
                        
                    </tr>
                </table>
                <br>
                <nav class="text-center">
                    <ul class="pagination">
                      <li v-if="pagination.current_page > 1">
                        <a href="#" aria-label="Previous" @click.prevent="changePage(pagination.current_page - 1)">
                          <span aria-hidden="true">«</span>
                        </a>
                      </li>
                      <li v-for="page in pagesNumber" v-bind:class="[ page == isActived ? 'active' : '']">
                        <a href="#" @click.prevent="changePage(page)">
                          @{{ page }}
                        </a>
                      </li>
                      <li v-if="pagination.current_page < pagination.last_page">
                        <a href="#" aria-label="Next" @click.prevent="changePage(pagination.current_page + 1)">
                          <span aria-hidden="true">»</span>
                        </a>
                      </li>
                    </ul>
                  </nav>


    <div class="modal fade" id="create-item-flavour"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
          <h3 class="modal-title" id="myModalLabel">Add New Flavour</h3>
        </div>
        <div class="modal-body">
          <form method="post" enctype="multipart/form-data" v-on:submit.prevent="createItem" data-parsley-validate="">
            <div class="form-group">
              <label for="name">Flavour Name:</label>         
              <input type="text" name="name" class="form-control" v-model="newItem.name" required=""  /> 
              
            </div>
            <div class="form-group">
              <label for="price">Price:</label>
              <input type="text" name="price" class="form-control" v-model="newItem.price" required="" data-parsley-type="digits" />            
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-success">Submit</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="edit-flavour" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
        <h3 class="modal-title" id="myModalLabel">Edit Flavour</h3>
      </div>
      <div class="modal-body">
        <form method="post" enctype="multipart/form-data" v-on:submit.prevent="updateItem(fillItem.id)" data-parsley-validate="">
          <div class="form-group">
            <label for="name">Flavour Name:</label>
            <input type="text" name="name" class="form-control" v-model="fillItem.name" required="" />
          </div>
          <div class="form-group">
            <label for="price">Price:</label>
            <input type="text" name="price" class="form-control" v-model="fillItem.price" required="" data-parsley-type="digits" />
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-success">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div> 
</div>



                </div>
                <div class="tab-pane" id="manage_shape">              
                    <table id="shape" class="display">
                    <br><br>
                    <tr>
                        <th style="text-align:center">No.</th>
                        <th style="text-align:center">Shape</th>
                        <th style="text-align:center">Availability</th>
                    </tr>
                    <tr v-for="shape in shapes">
                        <td>@{{shapes.indexOf(shape)+1}}</td>
                        <td>@{{shape.name}}</td>
                        <td>
                        <input type="checkbox" v-model="shape.availability" @click="clickCheckBox(shape)">
                        </td>
                    </tr>
                </table>
                </div>

                
                <div class="tab-pane" id="manage_frosting">
                    <br><br>
                    <table id="colour" class="display">
                    <tr>
                        <th style="text-align:center">Frosting | Color %</th>
                        <th style="text-align:center">1% - 25%</th>
                        <th style="text-align:center">26% - 50%</th>
                        <th style="text-align:center">51% - 75%</th>
                        <th style="text-align:center">76% - 100%</th>
                        <th style="text-align:center">Availabilty</th>
                        <th style="text-align:center">Action</th>
                        
                    </tr>
                    <tr v-for="frosting in frostings">
                        <th>@{{frosting.name}}</th>
                        <td>@{{frosting.one}}</td>
                        <td>@{{frosting.two}}</td>
                        <td>@{{frosting.three}}</td>
                        <td>@{{frosting.four}}</td>
                        <td><input type="checkbox" v-model="frosting.availability" @click="clickCheckBox(frosting)"></td>
                        <td>
                            <button class="edit-modal btn btn-info btn btn-sm" @click.prevent="editItem(frosting)">
                            <span class="glyphicon glyphicon-edit"></span> 
                          </button>
                          </button></td>                     
                    </tr>
                </table>

                  <div class="modal fade" id="edit-frosting-ganache" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
        <h3 class="modal-title" id="myModalLabel">Edit @{{frostings[fillItem.id-1].name}} Price</h3>
      </div>
<div class="modal-body">
        <form method="post" enctype="multipart/form-data" v-on:submit.prevent="updateItem(fillItem.id)" data-parsley-validate="">
          <div class="form-group">
            <label for="one">Price:</label>
            <input type="text" name="one" class="form-control" v-model="fillItem.one" required="" data-parsley-type="digits" />
          </div>
          <div class="form-group">
            <label for="availability">Availability:</label>
            <input type="checkbox" name="availability"  v-model="fillItem.availability" />
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-success">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div> 
</div>

<div class="modal fade" id="edit-frosting" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
        <h3 class="modal-title" id="myModalLabel">Edit @{{frostings[fillItem.id-1].name}} Price</h3>
      </div>
      <div class="modal-body">
        <form method="post" enctype="multipart/form-data" v-on:submit.prevent="updateItem(fillItem.id)" data-parsley-validate="">
          <div class="form-group">
            <label for="one">Price For 1% - 25% Color:</label>
            <input type="text" name="one" class="form-control" v-model="fillItem.one" required="" data-parsley-type="digits" />
          </div>
                    <div class="form-group">
            <label for="two">Price For 26% - 50% Color:</label>
            <input type="text" name="two" class="form-control" v-model="fillItem.two" required="" data-parsley-type="digits" />
          </div>
          <div class="form-group">
            <label for="three">Price For 51% - 75% Color:</label>
            <input type="text" name="three" class="form-control" v-model="fillItem.three" required="" data-parsley-type="digits" />
          </div>
          <div class="form-group">
            <label for="four">Price For 76% - 100% Color:</label>
            <input type="text" name="four" class="form-control" v-model="fillItem.four" required="" data-parsley-type="digits" />
          </div>
          <div class="form-group">
            <label for="availability">Availability:</label>
            <input type="checkbox" name="availability"  v-model="fillItem.availability" />
          </div>


          <div class="form-group">
            <button type="submit" class="btn btn-success">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div> 
</div>

                </div>

                <div class="tab-pane" id="decorations">
                    <div class="row" align="center">
                        <div>
                        <br><input type="text" id="materialInput" name="search" @keyup="searchDecoration()" v-model="search" class="form-control"  placeholder="Search for materials..">
                        <br>
                        </div>                
                    </div>
                    <div class="row text-center">
                    
                        <div class="col-md-3 portfolio-item" v-for="decoration in decorations">

                            <img height="150" width="150" src="{{ asset('images/decorations/')}}/@{{decoration.image}}"><br>
                            <b>@{{decoration.name}}</b> <br> Rp. @{{decoration.price}} <br><br>
                            <button class="edit-modal btn btn-info btn btn-sm" @click.prevent="editItem(decoration)">
                            <span class="glyphicon glyphicon-edit"></span> 
                          </button>
                            <div class="checkbox">
                                <label><input type="checkbox" v-model="decoration.availability" @click="clickCheckBox(decoration)"  >Availability</label>
                            </div>
                            <br>
                        </div>
                    </div>
                    <br><br>
                    <nav class="text-center">
                    <ul class="pagination">
                      <li v-if="pagination.current_page > 1">
                        <a href="#" aria-label="Previous" @click.prevent="changePage(pagination.current_page - 1)">
                          <span aria-hidden="true">«</span>
                        </a>
                      </li>
                      <li v-for="page in pagesNumber" v-bind:class="[ page == isActived ? 'active' : '']">
                        <a href="#" @click.prevent="changePage(page)">
                          @{{ page }}
                        </a>
                      </li>
                      <li v-if="pagination.current_page < pagination.last_page">
                        <a href="#" aria-label="Next" @click.prevent="changePage(pagination.current_page + 1)">
                          <span aria-hidden="true">»</span>
                        </a>
                      </li>
                    </ul>
                  </nav>

                  <div class="modal fade" id="edit3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
        <h3 class="modal-title" id="myModalLabel">Edit Decoration </h3>
      </div>
<div class="modal-body">
        <form method="post" enctype="multipart/form-data" v-on:submit.prevent="updateItem(fillItem.id)" data-parsley-validate="">
          <div class="form-group">
            <label for="one">Name:</label>
            <input type="text" name="one" class="form-control" v-model="fillItem.name" required="" />
          </div>
          <div class="form-group">
            <label for="one">Price:</label>
            <input type="text" name="one" class="form-control" v-model="fillItem.price" required="" data-parsley-type="digits" />
          </div>
          <div class="form-group">
            <label for="availability">Availability:</label>
            <input type="checkbox" name="availability"  v-model="fillItem.availability" />
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-success">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div> 
</div>

                
                    
                </div>
                
                <div class="tab-pane" id="manage_pipe">
                    <div class="row" align="center">
                            <br>
                             <form>
                                <div class="form-group">
                                  <label for="sel2" align="center">Types:</label>
                                  <select name="formb" onchange="location = this.value;">
                                    <option value="#pipe-top">Pipe Top</option>
                                    <option value="#pipe-edge">Pipe Edge & Bottom</option>
                                    <option value="#sprinkles">Sprinkles</option>
                                  </select>                                
                                </div>
                              </form>
                    </div>                   
                    <div class="row " id="pipe-top">
                    <h3 style="text-align:center;">Pipe Top</h3><br>
                      <div class="row text-center">
                        <div class="col-md-2 portfolio-item" v-for="pipe in pipes">
                            <img height="100" width="100" src="{{ asset('images/pipe0')}}/@{{pipe.image}}"><br>
                            <b>@{{pipe.name}}</b> <br> Rp. @{{pipe.price}} <br><br>
                                                        <button class="edit-modal btn btn-info btn btn-sm" @click.prevent="editItem(pipe)">
                            <span class="glyphicon glyphicon-edit"></span> 
                          </button>
                            <div class="checkbox">
                                <label><input type="checkbox" v-model="pipe.availability" @click="clickCheckBox(pipe)"  >Availability</label>
                            </div>
                            <br>
                        </div>
                      </div>
                        


                        <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
        <h3 class="modal-title" id="myModalLabel">Edit @{{pipes[fillItem.id-1].name}} Price</h3>
      </div>
<div class="modal-body">
        <form method="post" enctype="multipart/form-data" v-on:submit.prevent="updateItem(fillItem.id)" data-parsley-validate="">
          <div class="form-group">
            <label for="one">Price:</label>
            <input type="text" name="one" class="form-control" v-model="fillItem.price" required="" data-parsley-type="digits" />
          </div>
          <div class="form-group">
            <label for="availability">Availability:</label>
            <input type="checkbox" name="availability"  v-model="fillItem.availability" />
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-success">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div> 
</div>
                        
                        
                    </div>
                    
                    <br><br>
                    
                    <div class="row " id="pipe-edge">
                    <h3 style="text-align:center;">Pipe Edge - Bottom </h3><br>
                      <div class="row text-center">
                        <div class="col-md-2 portfolio-item" v-for="pipe in pipes">
                            <img height="100" width="100" src="{{ asset('images/pipe1')}}/@{{pipe.image}}"><br>
                            <b>@{{pipe.name}}</b> <br> Rp. @{{pipe.price}} <br><br>
                          <button class="edit-modal btn btn-info btn btn-sm" @click.prevent="editItem(pipe)">
                            <span class="glyphicon glyphicon-edit"></span> 
                          </button>
                            <div class="checkbox">
                                <label><input type="checkbox" v-model="pipe.availability" @click="clickCheckBox(pipe)"  >Availability</label>
                            </div>
                            <br>
                        </div>
                      </div>
                        


                        <div class="modal fade" id="edit1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
        <h3 class="modal-title" id="myModalLabel">Edit @{{pipes[fillItem.id-1].name}} Price</h3>
      </div>
<div class="modal-body">
        <form method="post" enctype="multipart/form-data" v-on:submit.prevent="updateItem(fillItem.id)" data-parsley-validate="">
          <div class="form-group">
            <label for="one">Price:</label>
            <input type="text" name="one" class="form-control" v-model="fillItem.price" required="" data-parsley-type="digits" />
          </div>
          <div class="form-group">
            <label for="availability">Availability:</label>
            <input type="checkbox" name="availability"  v-model="fillItem.availability" />
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-success">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div> 
</div>
                        
                        
                    </div>
                    
                    <br><br>
                    <div class="row " id="sprinkles">
                    <h3 style="text-align:center;">Sprinkles</h3><br>
                      <div class="row text-center">
                        <div class="col-md-2 portfolio-item" v-for="sprinkle in sprinkles">
                            <img height="100" width="100" src="{{ asset('images/sprinkles')}}/@{{sprinkle.image}}"><br>
                            <b>@{{sprinkle.name}}</b> <br> Rp. @{{sprinkle.price}} <br><br>
                          <button class="edit-modal btn btn-info btn btn-sm" @click.prevent="editItem(pipe)">
                            <span class="glyphicon glyphicon-edit"></span> 
                          </button>
                            <div class="checkbox">
                                <label><input type="checkbox" v-model="sprinkle.availability" @click="clickCheckBox(sprinkle)"  >Availability</label>
                            </div>
                            <br>
                        </div>
                      </div>
                        


                        <div class="modal fade" id="edit2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
        <h3 class="modal-title" id="myModalLabel">Edit @{{sprinkles[fillItem.id-1].name}} Price</h3>
      </div>
<div class="modal-body">
        <form method="post" enctype="multipart/form-data" v-on:submit.prevent="updateItem(fillItem.id)" data-parsley-validate="">
          <div class="form-group">
            <label for="one">Price:</label>
            <input type="text" name="one" class="form-control" v-model="fillItem.price" required="" data-parsley-type="digits" />
          </div>
          <div class="form-group">
            <label for="availability">Availability:</label>
            <input type="checkbox" name="availability"  v-model="fillItem.availability" />
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-success">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div> 
</div>
                    
                    
                
            </div>
        </div>
    </section>
                
@endsection