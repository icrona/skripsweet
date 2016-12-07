@extends('admin')

@section('title', '| Signatures')

@section('stylesheets')
<link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
    <style>
        * {
          box-sizing: border-box;
        }

        #sigInput {
          background-position: 10px 10px;
          background-repeat: no-repeat;
          width: 100%;
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

        #exTab1 .tab-content {
            
            background-color: rgba(255,255,255,1);
            padding : 5px 15px;
            border-radius: 5px 5px 5px 5px;
            }
            a{
                        color:#df744a;
                    }
    </style>
@endsection

@section('content')
    <section id="materials">
    
        <div class="container">
            <h2>Signatures Cakes</h2><br>         
        </div>
        <div id="exTab1" class="container">
            <ul class="nav nav-pills nav-justified">
                <li class="active">
                    <a href="#cake-birthday" data-toggle="tab">Birthday</a>
                </li>
                <li>
                    <a href="#cake-anniversary" data-toggle="tab">Anniversary</a>
                </li>
                <li>
                    <a href="#cake-seasonal" data-toggle="tab">Seasonal</a>
                </li>
            </ul>
            
            <div class="tab-content clearfix">

                <div class="tab-pane active" id="cake-birthday">
                    <br>
                    <input type="text" id="sigInput" name="search" @keyup="searchCake()" v-model="search" class="form-control" placeholder="Search for birthday cake..."><br>
                    <br>
                    <div class="row text-center" >
                            <button type="button" data-toggle="modal" data-target="#create-item-birthday" class="btn btn-primary" >
                        Add Cake
                      </button> <br><br>                       
                    </div>
                    <div class="row text-center">
                        <div class="col-md-3 portfolio-item" v-for="cake in cakes">
                            <img class="img-responsive img-thumbnail" src="{{ asset('images/')}}/@{{cake.image}}"><br>
                            <b>@{{cake.name}}</b> <br>RP. @{{cake.price}} <br><br>
                            <button class="edit-modal btn btn-warning btn btn-sm" @click.prevent="editItem(cake)">
                            <span class="glyphicon glyphicon-edit"></span> 
                          </button>
                          <button class="delete-btn delete-modal btn btn-danger btn btn-sm" @click.prevent="deleteItem(cake)">
                            <span class="glyphicon glyphicon-trash"></span> 
                          </button>
                            <br> <br>
                        </div>                                                
                    </div>
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

                <div class="modal fade" id="create-item-birthday"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                          </button>
                          <h3 class="modal-title" id="myModalLabel">Add New Cake</h3>
                        </div>
                        <div class="modal-body">
                          <form method="post" enctype="multipart/form-data"  v-on:submit.prevent="upload" data-parsley-validate="">
                            <div class="form-group">
                              <label for="name">Name:</label>                            
                              <input type="text" name="name" class="form-control" v-model="newItem.name" required=""/>  
                            </div>

                            <div class="form-group">
                              <label for="description">Description:</label>
                              <textarea name="description" class="form-control" v-model="newItem.description" required="">
                              </textarea>                              
                            </div>

                            <div class="form-group">
                                <label for="category">Category:</label>
                                <select name="category" class="form-control" v-model="newItem.category" required="">
                                  <option>Birthday</option>
                                  <option>Anniversary</option>
                                  <option>Seasonal</option>
                                </select>
                            </div>

                            <div class="form-group">
                              <label for="size">Size:</label>                            
                              <input type="text" name="size" class="form-control" v-model="newItem.size" required="" data-parsley-type="digits"/>  
                            </div>

                            <div class="form-group">
                              <label for="price">Price:</label>                            
                              <input type="text" name="price" class="form-control" v-model="newItem.price" required="" data-parsley-type="digits"/>  
                            </div>

                            <div class="form-group">
                              <label for="image">Image:</label>                            
                              <input type="file" name="image" class="form-control"  @change="onFileChange" required="" />  
                            </div>

                            <div class="form-group">
                              <button type="submit" class="btn btn-success">Submit</button>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="modal fade" id="edit-birthday" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">×</span>
                        </button>
                        <h3 class="modal-title" id="myModalLabel">Edit Cake</h3>
                      </div>
                      <div class="modal-body">
                        <form method="post" enctype="multipart/form-data" v-on:submit.prevent="uploadEdit(fillItem.id)" data-parsley-validate="">

                        <div class="form-group">
                              <label for="name">Name:</label>                            
                              <input type="text" name="name" class="form-control" v-model="fillItem.name" required=""/>  
                            </div>

                            <div class="form-group">
                              <label for="description">Description:</label>
                              <textarea name="description" class="form-control" v-model="fillItem.description" required="">
                              </textarea>                              
                            </div>

                            <div class="form-group">
                                <label for="category">Category:</label>
                                <select name="category" class="form-control" v-model="fillItem.category" required="">
                                  <option>Birthday</option>
                                  <option>Anniversary</option>
                                  <option>Seasonal</option>
                                </select>
                            </div>

                            <div class="form-group">
                              <label for="size">Size:</label>                            
                              <input type="text" name="size" class="form-control" v-model="fillItem.size" required="" data-parsley-type="digits"/>  
                            </div>

                            <div class="form-group">
                              <label for="price">Price:</label>                            
                              <input type="text" name="price" class="form-control" v-model="fillItem.price" required="" data-parsley-type="digits"/>  
                            </div>

                            <div class="form-group">
                              <label for="image">Image:</label>                            
                              <input type="file" name="image" class="form-control"  @change="onFileChange" />
                              @{{ fillItem.image}}  
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
            <div class="tab-pane" id="cake-anniversary">
                    <br>
                    <input type="text" id="sigInput" name="search" @keyup="searchCake()" v-model="search" class="form-control" placeholder="Search for anniversary cake..."><br>
                    <br>
                    <div class="row text-center" >
                            <button type="button" data-toggle="modal" data-target="#create-item-anniversary" class="btn btn-primary" >
                        Add Cake
                      </button> <br><br>                       
                    </div>
                    <div class="row text-center">
                        <div class="col-md-3 portfolio-item" v-for="cake in cakes">
                            <img class="img-responsive img-thumbnail" src="{{ asset('images/')}}/@{{cake.image}}"><br>
                            <b>@{{cake.name}}</b> <br>RP. @{{cake.price}} <br><br>
                            <button class="edit-modal btn btn-warning btn btn-sm" @click.prevent="editItem(cake)">
                            <span class="glyphicon glyphicon-edit"></span> 
                          </button>
                          <button class="delete-btn delete-modal btn btn-danger btn btn-sm" @click.prevent="deleteItem(cake)">
                            <span class="glyphicon glyphicon-trash"></span> 
                          </button>
                            <br> <br>
                        </div>                                                
                    </div>
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

                <div class="modal fade" id="create-item-anniversary"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                          </button>
                          <h3 class="modal-title" id="myModalLabel">Add New Cake</h3>
                        </div>
                        <div class="modal-body">
                          <form method="post" enctype="multipart/form-data"  v-on:submit.prevent="upload" data-parsley-validate="">
                            <div class="form-group">
                              <label for="name">Name:</label>                            
                              <input type="text" name="name" class="form-control" v-model="newItem.name" required=""/>  
                            </div>

                            <div class="form-group">
                              <label for="description">Description:</label>
                              <textarea name="description" class="form-control" v-model="newItem.description" required="">
                              </textarea>                              
                            </div>

                            <div class="form-group">
                                <label for="category">Category:</label>
                                <select name="category" class="form-control" v-model="newItem.category" required="">
                                  <option>Birthday</option>
                                  <option>Anniversary</option>
                                  <option>Seasonal</option>
                                </select>
                            </div>

                            <div class="form-group">
                              <label for="size">Size:</label>                            
                              <input type="text" name="size" class="form-control" v-model="newItem.size" required="" data-parsley-type="digits"/>  
                            </div>

                            <div class="form-group">
                              <label for="price">Price:</label>                            
                              <input type="text" name="price" class="form-control" v-model="newItem.price" required="" data-parsley-type="digits"/>  
                            </div>

                            <div class="form-group">
                              <label for="image">Image:</label>                            
                              <input type="file" name="image" class="form-control"  @change="onFileChange" required="" />  
                            </div>

                            <div class="form-group">
                              <button type="submit" class="btn btn-success">Submit</button>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="modal fade" id="edit-anniversary" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">×</span>
                        </button>
                        <h3 class="modal-title" id="myModalLabel">Edit Cake</h3>
                      </div>
                      <div class="modal-body">
                        <form method="post" enctype="multipart/form-data" v-on:submit.prevent="uploadEdit(fillItem.id)" data-parsley-validate="">

                        <div class="form-group">
                              <label for="name">Name:</label>                            
                              <input type="text" name="name" class="form-control" v-model="fillItem.name" required=""/>  
                            </div>

                            <div class="form-group">
                              <label for="description">Description:</label>
                              <textarea name="description" class="form-control" v-model="fillItem.description" required="">
                              </textarea>                              
                            </div>

                            <div class="form-group">
                                <label for="category">Category:</label>
                                <select name="category" class="form-control" v-model="fillItem.category" required="">
                                  <option>Birthday</option>
                                  <option>Anniversary</option>
                                  <option>Seasonal</option>
                                </select>
                            </div>

                            <div class="form-group">
                              <label for="size">Size:</label>                            
                              <input type="text" name="size" class="form-control" v-model="fillItem.size" required="" data-parsley-type="digits"/>  
                            </div>

                            <div class="form-group">
                              <label for="price">Price:</label>                            
                              <input type="text" name="price" class="form-control" v-model="fillItem.price" required="" data-parsley-type="digits"/>  
                            </div>

                            <div class="form-group">
                              <label for="image">Image:</label>                            
                              <input type="file" name="image" class="form-control"  @change="onFileChange" /> 
                            </div>
                          
                          <div class="form-group">
                            <button type="submit" class="btn btn-success">Submit</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div> 
                </div>
                <div class="modal fade" id="create-item-birthday"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                          </button>
                          <h3 class="modal-title" id="myModalLabel">Add New Cake</h3>
                        </div>
                        <div class="modal-body">
                          <form method="post" enctype="multipart/form-data"  v-on:submit.prevent="upload" data-parsley-validate="">
                            <div class="form-group">
                              <label for="name">Name:</label>                            
                              <input type="text" name="name" class="form-control" v-model="newItem.name" required=""/>  
                            </div>

                            <div class="form-group">
                              <label for="description">Description:</label>
                              <textarea name="description" class="form-control" v-model="newItem.description" required="">
                              </textarea>                              
                            </div>

                            <div class="form-group">
                                <label for="category">Category:</label>
                                <select name="category" class="form-control" v-model="newItem.category" required="">
                                  <option>Birthday</option>
                                  <option>Anniversary</option>
                                  <option>Seasonal</option>
                                </select>
                            </div>

                            <div class="form-group">
                              <label for="size">Size:</label>                            
                              <input type="text" name="size" class="form-control" v-model="newItem.size" required="" data-parsley-type="digits"/>  
                            </div>

                            <div class="form-group">
                              <label for="price">Price:</label>                            
                              <input type="text" name="price" class="form-control" v-model="newItem.price" required="" data-parsley-type="digits"/>  
                            </div>

                            <div class="form-group">
                              <label for="image">Image:</label>                            
                              <input type="file" name="image" class="form-control"  @change="onFileChange" required="" />  
                            </div>

                            <div class="form-group">
                              <button type="submit" class="btn btn-success">Submit</button>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="modal fade" id="edit-seasonal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">×</span>
                        </button>
                        <h3 class="modal-title" id="myModalLabel">Edit Cake</h3>
                      </div>
                      <div class="modal-body">
                        <form method="post" enctype="multipart/form-data" v-on:submit.prevent="uploadEdit(fillItem.id)" data-parsley-validate="">

                        <div class="form-group">
                              <label for="name">Name:</label>                            
                              <input type="text" name="name" class="form-control" v-model="fillItem.name" required=""/>  
                            </div>

                            <div class="form-group">
                              <label for="description">Description:</label>
                              <textarea name="description" class="form-control" v-model="fillItem.description" required="">
                              </textarea>                              
                            </div>

                            <div class="form-group">
                                <label for="category">Category:</label>
                                <select name="category" class="form-control" v-model="fillItem.category" required="">
                                  <option>Birthday</option>
                                  <option>Anniversary</option>
                                  <option>Seasonal</option>
                                </select>
                            </div>

                            <div class="form-group">
                              <label for="size">Size:</label>                            
                              <input type="text" name="size" class="form-control" v-model="fillItem.size" required="" data-parsley-type="digits"/>  
                            </div>

                            <div class="form-group">
                              <label for="price">Price:</label>                            
                              <input type="text" name="price" class="form-control" v-model="fillItem.price" required="" data-parsley-type="digits"/>  
                            </div>

                            <div class="form-group">
                              <label for="image">Image:</label>                            
                              <input type="file" name="image" class="form-control"  @change="onFileChange" />  
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
            <div class="tab-pane" id="cake-seasonal">
                    <br>
                    <input type="text" id="sigInput" name="search" @keyup="searchCake()" v-model="search" class="form-control" placeholder="Search for seasonal cake..."><br>
                    <br>
                    <div class="row text-center" >
                            <button type="button" data-toggle="modal" data-target="#create-item-seasonal" class="btn btn-primary" >
                        Add Cake
                      </button> <br><br>                       
                    </div>
                    <div class="row text-center">
                        <div class="col-md-3 portfolio-item" v-for="cake in cakes">
                            <img class="img-responsive img-thumbnail" src="{{ asset('images/')}}/@{{cake.image}}"><br>
                            <b>@{{cake.name}}</b> <br>RP. @{{cake.price}} <br><br>
                            <button class="edit-modal btn btn-warning btn btn-sm" @click.prevent="editItem(cake)">
                            <span class="glyphicon glyphicon-edit"></span> 
                          </button>
                          <button class="delete-btn delete-modal btn btn-danger btn btn-sm" @click.prevent="deleteItem(cake)">
                            <span class="glyphicon glyphicon-trash"></span> 
                          </button>
                            <br> <br>
                        </div>                                                
                    </div>
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

                <div class="modal fade" id="create-item-seasonal"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                          </button>
                          <h3 class="modal-title" id="myModalLabel">Add New Cake</h3>
                        </div>
                        <div class="modal-body">
                          <form method="post" enctype="multipart/form-data"  v-on:submit.prevent="upload" data-parsley-validate="">
                            <div class="form-group">
                              <label for="name">Name:</label>                            
                              <input type="text" name="name" class="form-control" v-model="newItem.name" required=""/>  
                            </div>

                            <div class="form-group">
                              <label for="description">Description:</label>
                              <textarea name="description" class="form-control" v-model="newItem.description" required="">
                              </textarea>                              
                            </div>

                            <div class="form-group">
                                <label for="category">Category:</label>
                                <select name="category" class="form-control" v-model="newItem.category" required="">
                                  <option>Birthday</option>
                                  <option>Anniversary</option>
                                  <option>Seasonal</option>
                                </select>
                            </div>

                            <div class="form-group">
                              <label for="size">Size:</label>                            
                              <input type="text" name="size" class="form-control" v-model="newItem.size" required="" data-parsley-type="digits"/>  
                            </div>

                            <div class="form-group">
                              <label for="price">Price:</label>                            
                              <input type="text" name="price" class="form-control" v-model="newItem.price" required="" data-parsley-type="digits"/>  
                            </div>

                            <div class="form-group">
                              <label for="image">Image:</label>                            
                              <input type="file" name="image" class="form-control"  @change="onFileChange" required="" />  
                            </div>

                            <div class="form-group">
                              <button type="submit" class="btn btn-success">Submit</button>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">×</span>
                        </button>
                        <h3 class="modal-title" id="myModalLabel">Edit Cake</h3>
                      </div>
                      <div class="modal-body">
                        <form method="post" enctype="multipart/form-data" v-on:submit.prevent="uploadEdit(fillItem.id)" data-parsley-validate="">

                        <div class="form-group">
                              <label for="name">Name:</label>                            
                              <input type="text" name="name" class="form-control" v-model="fillItem.name" required=""/>  
                            </div>

                            <div class="form-group">
                              <label for="description">Description:</label>
                              <textarea name="description" class="form-control" v-model="fillItem.description" required="">
                              </textarea>                              
                            </div>

                            <div class="form-group">
                                <label for="category">Category:</label>
                                <select name="category" class="form-control" v-model="fillItem.category" required="">
                                  <option>Birthday</option>
                                  <option>Anniversary</option>
                                  <option>Seasonal</option>
                                </select>
                            </div>

                            <div class="form-group">
                              <label for="size">Size:</label>                            
                              <input type="text" name="size" class="form-control" v-model="fillItem.size" required="" data-parsley-type="digits"/>  
                            </div>

                            <div class="form-group">
                              <label for="price">Price:</label>                            
                              <input type="text" name="price" class="form-control" v-model="fillItem.price" required="" data-parsley-type="digits"/>  
                            </div>

                            <div class="form-group">
                              <label for="image">Image:</label>                            
                              <input type="file" name="image" class="form-control"  @change="onFileChange" />
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
    </section>
        
@endsection
