@extends('main')

@section('title', '| Cake Details')

@section('stylesheets')

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    {{ Html::style('css/sweetalert.css') }}
{{ Html::style('css/parsley.css') }}
            
    <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
    
    <style>       
    .stylish-panel {
            padding: 20px 0;
            text-align: center;
        }
        .stylish-panel > div > div{
            padding: 10px;
            border: 1px solid transparent;
            border-radius: 4px;
            transition: 0.2s;
        }
        .stylish-panel > div:hover > div{
            margin-top: -10px;
            border: 1px solid rgb(200, 200, 200);
            box-shadow: rgba(0, 0, 0, 0.1) 0px 5px 5px 2px;
            background: rgba(200, 200, 200, 0.1);
            transition: 0.5s;
        }

        .stylish-panel > div:hover img {
            border-radius: 50%;
            -webkit-transform: rotate(360deg);
            -moz-transform: rotate(360deg);
            -o-transform: rotate(360deg);
            -ms-transform: rotate(360deg);
            transform: rotate(360deg);
        }

    </style>    
@endsection

@section('content')
    <section class="container-fluid features" id="order1">
        <div class="container">
            <div class="row stylish-panel">
                <div class="col-md-4 col-md-offset-2">
                    <div>
                      <img src="{{asset('images/'.$cake->image)}}" class="img-circle img-thumbnail">
                    </div>
                </div>
                <div class="col-md-4">
                    <h2>{{$cake->name}}</h2>
                    <h4>{{$cake->description}}</h4>
                    <h4>Size : {{$cake->size}} cm</h4>
                    <h1>Rp. {{$cake->price}}</h1>
                    <a href="#input" class="btn btn-primary page-scroll text-center">Order</a>
                </div>
            </div>           
        </div>
    </section>

    <section class="container-fluid" style="background-color:#ffe0b3;" id="input">
        <div class="container">
            <h2 class="text-center">Customer Data</h2>
            <br><br>
            {!! Form::open(['route' => ['gallery.order',$cake->id],'data-parsley-validate'=>'','class'=>'create_form']) !!}
                <div class="row">
                    <div class="col-md-2 col-md-offset-3">
                        {{Form::label('name','Name:')}}
                    </div>
                    <div class="col-md-4">
                        {{Form::text('name',null,array('class'=>'form-control','required'=>'','maxlength'=>'255'))}}
                    </div>                
                </div>
                <br>

                <div class="row">
                    <div class="col-md-2 col-md-offset-3">
                        {{Form::label('phone','Phone:')}}
                    </div>
                    <div class="col-md-4">
                        {{Form::text('phone',null,array('class'=>'form-control','required'=>'','data-parsley-type'=>'digits'))}}
                    </div>               
                </div>
                <br>

                <div class="row">
                    <div class="col-md-2 col-md-offset-3">
                        {{Form::label('email',"Email:")}}
                    </div>
                    <div class="col-md-4">
                        {{Form::text('email',null,array('class'=>'form-control','required'=>'','data-parsley-type'=>'email'))}}
                    </div>              
                </div>
                <br>

                <div class="row dateInput">
                    <div class="col-md-2 col-md-offset-3">
                        {{Form::label('date',"Date:")}}
                        <p style="color: red; font-size:12px;">Minimum {{$days}} day(s) from today</p>
                    </div>
                    <div class="col-md-4">
                        {{Form::date('date',\Carbon\Carbon::now()->addDays($days),array('class'=>'form-control','required'=>'','min'=> \Carbon\Carbon::now()->addDays($days)->toDateString()))}}
                    </div>              
                </div>
                <br>

                <div class="row">
                    <div class="col-md-2 col-md-offset-3">
                        {{Form::label('address',"Address:")}}
                    </div>
                    <div class="col-md-4">
                        {{Form::textarea('address',null,array('class'=>'form-control','required'=>''))}}
                    </div>              
                </div>
                <br>

                <div class="row">
                    <div class="col-md-2 col-md-offset-3">
                        {{Form::label('notes',"Notes:")}}
                    </div>
                    <div class="col-md-4">
                        {{Form::textarea('notes',null,array('class'=>'form-control'))}}
                    </div>              
                </div>
                <br>

                <div class="row">        
                  <div class="col-md-offset-5 col-md-2 text-center">
                  {{Form::submit('Order Now',['class' =>'btn btn-success btn-block btn-order'])}}
                  </div>
                </div>

            {!! Form::close() !!}
        </div>
    </section>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    {{ Html::script('/js/parsley.min.js') }}
    {{ Html::script('/js/sweetalert.min.js') }}

    <script type="text/javascript">
        $('form').parsley({
            excluded: '.dateInput input'
        });
    </script>

@endsection
