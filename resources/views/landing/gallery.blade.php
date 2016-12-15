@extends('main')

@section('title', '| Cake Gallery')

@section('stylesheets')
    <!--FAQ CSS-->
    <link rel="stylesheet" type="text/css" href="faq/font-awesome/css/font-awesome.min.css" />
    <script type="text/javascript" src="faq/js/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="faq/bootstrap/js/bootstrap.min.js"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    
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

        .stylish-panel > div:hover img {
            border-radius: 50%;
        }
        .grow { transition: all .2s ease-in-out; }
            .grow:hover { transform: scale(1.1); }

    </style>    
@endsection

@section('content')
<section id="materials">
    
        <div class="container">
            <h2 class="text-center">Cake Gallery</h2><br>         
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
                    
                    <div class="row stylish-panel">
                        @foreach($birthdays as $birthday)
                        <div class="col-md-4">
                            <div>
                              <img src="{{asset('images/'.$birthday->image)}}" class="img-circle img-thumbnail grow">
                              <h3>{{$birthday->name}}</h3>
                              <p>Rp. {{$birthday->price}}</p>
                              <a href="{{route('gallery.show',$birthday->id)}}" class="btn btn-primary" title="Order">Order</a>
                            <br><br>

                            </div>
                        </div>
                        @endforeach

                        {{ $birthdays->links() }}                                                
                    </div>
                </div>

                <div class="tab-pane" id="cake-anniversary">
                    
                    <div class="row stylish-panel">
                        @foreach($anniversarys as $anniversary)
                        <div class="col-md-4">
                            <div>
                              <img src="{{asset('images/'.$anniversary->image)}}" class="img-circle img-thumbnail grow">
                              <h3>{{$anniversary->name}}</h3>
                              <p>Rp. {{$anniversary->price}}</p>
                              <a href="{{route('gallery.show',$anniversary->id)}}" class="btn btn-primary" title="Order">Order</a>
                              <br><br>
                            </div>
                        </div>
                        @endforeach

                        {{ $anniversarys->links() }}                                                
                    </div>
                </div>

                <div class="tab-pane" id="cake-seasonal">
                    
                    <div class="row stylish-panel">
                        @foreach($seasonals as $seasonal)
                        <div class="col-md-4">
                            <div>
                              <img src="{{asset('images/'.$seasonal->image)}}" class="img-circle img-thumbnail grow">
                              <h3>{{$seasonal->name}}</h3>
                              <p>Rp. {{$seasonal->price}}</p>
                              <a href="{{route('gallery.show',$seasonal->id)}}" class="btn btn-primary" title="Order">Order</a>
                              <br><br>
                            </div>
                        </div>
                        @endforeach

                        {{ $seasonals->links() }}                                                
                    </div>
                </div>
            </div>
        </div>
    </section>
	
@endsection
