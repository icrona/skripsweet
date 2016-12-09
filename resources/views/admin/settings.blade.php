@extends('admin')

@section('title', '| Settings')

@section('stylesheets')
<link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css">
    <style>
table {
                        border-collapse: collapse;
                        width: 100%;
                    }

                    th, td {
                    border: 0px;
                    text-align:justify;
                    padding: 8px;
                    }
                    
                    tr:nth-child(even){
                        background-color:rgba(255, 255, 255,1);
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

                    
        .fileUpload {
                position: relative;
                overflow: hidden;
                margin: 10px;
            }
        .fileUpload input.upload {
            position: absolute;
            top: 0;
            right: 0;
            margin: 0;
            padding: 0;
            font-size: 20px;
            cursor: pointer;
            opacity: 0;
            filter: alpha(opacity=0);
        }
            #exTab1 .tab-content {
            
            background-color: rgba(255,255,255,1);
            padding : 5px 15px;
            border-radius: 5px 5px 5px 5px;
            }

            h2{
                text-align:center;
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
    </style>
@endsection

@section('content')

            <section id="settings" class="container-fluid" >
        <style>
            h2{
                text-align:center;
            }
        </style>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
        <h2>Settings</h2><br><br>
        
        <div id="exTab1" class="container">
        
        
            <ul class="nav nav-pills nav-justified">
                <li class="active">
                    <a href="#1" data-toggle="tab">Profile</a>
                </li>
                <li>
                    <a href="#2" data-toggle="tab">Account</a>
                </li>
                <li>
                    <a href="#manage-faq" data-toggle="tab">FAQ</a>
                </li>
            </ul>
            
            <div class="tab-content clearfix">
                <div class="tab-pane active" id="1">
                <h3 style="text-align:center;">Edit Profile</h3>
                <br>
                {!!Form::model($profile,['route'=>'settings.profile','method'=>'PUT','data-parsley-validate'=>'','class'=>'edit_profile','files'=>'true'])!!}
                
                <div class="row">
                  <div class="col-md-3 col-md-offset-2">
                    {{Form::label('name','Name')}}
                  </div>                 
                  <div class="col-md-5">
                    {{Form::text('name',null,array('class'=>'form-control','required'=>'','maxlength'=>'255'))}}
                  </div>
                </div>
                <br>

                <div class="row">
                  <div class="col-md-3 col-md-offset-2">
                    {{Form::label('phone','Phone')}}
                  </div>                 
                  <div class="col-md-5">
                    {{Form::text('phone',null,array('class'=>'form-control','required'=>'','maxlength'=>'255','data-parsley-type'=>'digits'))}}
                  </div>
                </div>
                <br>

                <div class="row">
                  <div class="col-md-3 col-md-offset-2">
                    {{Form::label('logo_image','Logo Image')}}
                  </div>                 
                  <div class="col-md-5">
                     {{Form::file('logo_image')}}
                     <label style="color:red">*File must be .png</label>
                  </div>
                  <br><br><br>
                </div>
                <div class="row">
                  <div class="col-md-3 col-md-offset-2">
                    {{Form::label('days','Minimum Order Days')}}
                  </div>                 
                  <div class="col-md-5">
                    {{Form::text('days',null,array('class'=>'form-control','required'=>'','data-parsley-type'=>'digits'))}}
                  </div>
                </div>
                <br>
                <div class="row">
                  <div class="col-md-3 col-md-offset-2">
                    {{Form::label('bio','Biodata')}}
                  </div>                 
                  <div class="col-md-5">
                    {{Form::textarea('bio',null,array('class'=>'form-control','required'=>''))}}
                  </div>
                </div>
                <br><br>
                <div class="row">        
                  <div class="col-md-offset-5 col-md-2 text-center">
                    {{Form::submit('Save Changes',['class' =>'btn btn-success btn-block btn-submit'])}}
                  </div>
                </div>
                {!! Form::close() !!}
                </div>
                
                <div class="tab-pane" id="2">
                <h3 style="text-align:center;">Security</h3>
                <br>
                <form id="form-change-password" data-parsley-validate="" role="form" method="POST" action="{{ url('/settings/password') }}" novalidate class="form-horizontal">

                <div class="col-md-2 col-md-offset-3">             
                  <label for="current-password">Current Password</label>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                      <input type="hidden" name="_token" value="{{ csrf_token() }}"> 
                      <input type="password" class="form-control" required="" id="current-password" name="current-password" placeholder="Current Password">
                    </div>
                </div>

                <div class="col-md-2 col-md-offset-3"> 
                  <label for="password">New Password</label>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <input type="password" class="form-control" required="" minlength="6" data-parsley-equalto="#password_confirmation" id="password" name="password" placeholder="New Password">
                  </div>
                </div>

                <div class="col-md-2 col-md-offset-3">
                  <label for="password_confirmation">Confirmation Password</label>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <input type="password" class="form-control" required="" minlength="6" data-parsley-equalto="#password" id="password_confirmation" name="password_confirmation" placeholder="Confirmation Password">
                  </div>
                  <br>
                </div>
                

                <div class="col-md-offset-5 col-md-2 text-center">
                    <button type="submit" class="btn btn-warning btn-change">Change Password</button>
                </div>
              </form>
                </div> 

                <div class="tab-pane" id="manage-faq">
                <h3 style="text-align:center;">FAQ Settings</h3><br>

                <input type="text" id="sigInput" name="search" @keyup="searchFAQ()" v-model="search" class="form-control" placeholder="Search for FAQ Question..."><br>

                <div class="row">
                  <div class="col-md-2 col-md-offset-5 text-center">
                      <button type="button" data-toggle="modal" data-target="#create-item" class="btn btn-primary" >
                        Add Question
                      </button>
                  </div>                                                
                </div>

                <br>
                <div class="row">
                <div class="table-responsive">
                  <table class="table table-borderless" id="faq" class="display">
                    <tr>
                        <th style="text-align:center">Question</th>
                        <th style="text-align:center">Answer</th>
                        <th style="text-align:center">Action</th>
                    </tr>
                    <tr v-for="faq in faqs">
                        <td>@{{ faq.question }}</td>
                        <td>@{{ faq.answer }}</td>
                        <td>
                          <button class="edit-modal btn btn-warning btn btn-sm" @click.prevent="editItem(faq)">
                            <span class="glyphicon glyphicon-edit"></span> 
                          </button>
                          <button class="delete-btn delete-modal btn btn-danger btn btn-sm" @click.prevent="deleteItem(faq)">
                            <span class="glyphicon glyphicon-trash"></span> 
                          </button>
                        </td>                        
                    </tr>
                </table>
                </div>
                  
                </div>
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
<div class="modal fade" id="create-item"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
          <h3 class="modal-title" id="myModalLabel">Add New Question</h3>
        </div>
        <div class="modal-body">
          <form method="post" enctype="multipart/form-data" v-on:submit.prevent="createItem" data-parsley-validate="">
            <div class="form-group">
              <label for="Question">Question:</label>
              
              <textarea name="question" class="form-control" v-model="newItem.question" required=""> 
              </textarea>  
              
            </div>
            <div class="form-group">
              <label for="Answer">Answer:</label>
              <textarea name="answer" class="form-control" v-model="newItem.answer" required="">
              </textarea>
              
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
        <h3 class="modal-title" id="myModalLabel">Edit Question</h3>
      </div>
      <div class="modal-body">
        <form method="post" enctype="multipart/form-data" v-on:submit.prevent="updateItem(fillItem.id)" data-parsley-validate="">
          <div class="form-group">
            <label for="question">Question:</label>
            <textarea name="question" class="form-control" v-model="fillItem.question" required="">
            </textarea>
          </div>
          <div class="form-group">
            <label for="answer">Answer:</label>
            <textarea name="answer" class="form-control" v-model="fillItem.answer" required="">
            </textarea>
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

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    {{ Html::script('/js/parsley.min.js') }}
    {{ Html::script('/js/sweetalert.min.js') }}
    <script type="text/javascript">
        
      $('.btn-submit').on('click',function(e){
          e.preventDefault();
          var form = $(this).parents('form');
          form.parsley().validate();
          if(form.parsley().isValid()){
            swal({
              title: "Are you sure?",
              text: "You will update your profile",
              type: "info",
              showCancelButton: true,
              confirmButtonColor: "#DD6B55",
              confirmButtonText: "Yes",
              closeOnConfirm: true,
          }, function(isConfirm){
              if (isConfirm) form.submit();
          });
          }

      });

        $('.btn-change').on('click',function(e){
          e.preventDefault();
          var form = $(this).parents('form');
          form.parsley().validate();
          if(form.parsley().isValid()){
            swal({
                title: "Are you sure?",
                text: "You will be changed",
                type: "info",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes",
                closeOnConfirm: true,
            }, function(isConfirm){
                if (isConfirm) form.submit();
            });
          }

      });
    </script>

    


@endsection

