@extends('admin')

@section('title', '| Order Details')

@section('stylesheets')
<link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
<style>

        a{
                        color:#df744a;
                    }
</style>

@endsection

@section('content')

    <section id="details" :details ="{{$order->id}}" style="background-color:#bfd8d2;">
    @if($order->order_from == "Web")
        <div class="container">
        <div class="row">
            <div class="col-md-6 text-center">
                <img class="img-responsive img-thumbnail" src="{{asset('images/')}}/@{{orders.cake_image}}">
                <h3>@{{orders.cake_name}}</h3>
                <h4>Rp. @{{orders.cake_price}}</h4>
            </div>

            <div class="col-md-6">
                <h1>Order Details</h1>
                <h6>Date Received : @{{orders.created_at}}</h6>
                <h6>Status : @{{orders.status}}</h6>
                
                                <span v-if="checkStatus(orders.status)">
                                    <a @click.prevent=updateStatus("Accepted",orders) href="#">Accept</a>
                                    <a @click.prevent=updateStatus("Declined",orders) href="#">Decline</a>
                                    <br>
                                </span>
                
                <br>
                <h4>Name       : @{{orders.name}}<h4>
                <h4>Phone       : @{{orders.phone}}<h4>
                <h4>Email       : @{{orders.email}}<h4>
                <h4>Address       : @{{orders.address}}<h4>
                <h4>Delivery Date       : @{{orders.date}}<h4>
                @if($order->notes!='')
                <h4>Notes      : @{{orders.notes}}<h4>
                @endif
                <br>
                <a href="{{ route('pdfdetails',[$order->id,'download'=>'pdf']) }}" class="btn btn-info" role="button">Download PDF</a>
            </div>
        </div>
    </div>
    @else
            <div class="container">
        <div class="row">
            <div class="col-md-4 text-center">
                                    <div class="table-responsive">
                <table class="table">
                    <tr>
                        <td>
                            <img class="img-responsive img-thumbnail" src={{asset('images/'.$order->cake_image)}}>
                        </td>
                        <td>
                            <img class="img-responsive img-thumbnail" src={{asset('images/'.$order->cake_image1)}}>
                        </td>
                    </tr>
                        <tr>
                        <td>
                            <img class="img-responsive img-thumbnail" src={{asset('images/'.$order->cake_image2)}}>
                        </td>
                        <td>
                            <img class="img-responsive img-thumbnail" src={{asset('images/'.$order->cake_image3)}}>
                        </td>
                    </tr>
                </table>

            </div>

            </div> 
            <div class="col-md-3">
                <h1>Cake Details</h1>
                <h4>@{{orders.cake_name}}</h3>
                <h4>Rp. @{{orders.cake_price}}</h4>
                <h4>Size Tier 1: @{{orders.cake_size}}cm</h4>
                <h4 v-if="orders.cake_size1 != 0">Size Tier 2: @{{orders.cake_size1}}cm</h4>
                <h4 v-if="orders.cake_size2 != 0">Size Tier 3: @{{orders.cake_size2}}cm</h4>
                <h4>Flavour Tier 1: @{{orders.cake_flavour}}</h4>
                <h4 v-if="orders.cake_tier >1">Flavour Tier 2: @{{orders.cake_flavour1}}</h4>
                <h4 v-if="orders.cake_tier >2">Flavour Tier 3: @{{orders.cake_flavour2}}</h4>
                <h4>Frosting : @{{orders.cake_frosting}}</h4>
            </div>

            <div class="col-md-5">
                <h1>Order Details</h1>
                <h6>Date Received : @{{orders.created_at}}</h6>
                <h6>Status : @{{orders.status}}</h6>
                
                                <span v-if="checkStatus(orders.status)">
                                    <a @click.prevent=updateStatus("Accepted",orders) href="#">Accept</a>
                                    <a @click.prevent=updateStatus("Declined",orders) href="#">Decline</a>
                                    <br>
                                </span>
                
                <br>
                <h4>Name       : @{{orders.name}}<h4>
                <h4>Phone       : @{{orders.phone}}<h4>
                <h4>Email       : @{{orders.email}}<h4>
                <h4>Address       : @{{orders.address}}<h4>
                <h4>Delivery Date       : @{{orders.date}}<h4>
                @if($order->notes!='')
                <h4>Notes      : @{{orders.notes}}<h4>
                @endif
                <br>
                <a href="{{ route('pdfdetails',[$order->id,'download'=>'pdf']) }}" class="btn btn-info" role="button">Download PDF</a>
            </div>
        </div>
    </div>

    @endif

    </section>
@endsection
