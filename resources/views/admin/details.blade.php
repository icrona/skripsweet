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

    <section id="inbox" style="background-color:#bfd8d2;">
    <div class="container">
        <div class="row">
            <div class="col-md-6 text-center">
                <img class="img-responsive img-thumbnail" src={{asset('images/'.$order->cake_image)}}>
                <h3>{{$order->cake_name}}</h3>
                <h4>Rp. {{$order->cake_price}}</h4>
            </div>
                        {{--            <div class="table-responsive">
                <table class="table">
                    <tr>
                        <td>
                            <img class="img-responsive img-thumbnail" src={{asset('images/'.$order->cake_image)}}>
                        </td>
                        <td>
                            <img class="img-responsive img-thumbnail" src={{asset('images/'.$order->cake_image)}}>
                        </td>
                    </tr>
                        <tr>
                        <td>
                            <img class="img-responsive img-thumbnail" src={{asset('images/'.$order->cake_image)}}>
                        </td>
                        <td>
                            <img class="img-responsive img-thumbnail" src={{asset('images/'.$order->cake_image)}}>
                        </td>
                    </tr>
                </table>
            </div> --}}

            <div class="col-md-6">
                <h1>Order Details</h1>
                <h6>Date Received : {{$order->date}}</h6>
                <h6>Status : {{$order->status}}</h6>
                @if($order->status=='Waiting Confirmation')
                <a href="{{route('orders.status',[$order->id,'Accepted'])}}">Accept</a>
                <a href="{{route('orders.status',[$order->id,'Declined'])}}">Decline</a>
                <br>
                @endif
                <br>
                <h4>Name       : {{$order->name}}<h4>
                <h4>Phone       : {{$order->phone}}<h4>
                <h4>Email       : {{$order->email}}<h4>
                <h4>Address       : {{$order->address}}<h4>
                <h4>Delivery Date       : {{$order->date}}<h4>
                @if($order->notes!='')
                <h4>Notes      : {{$order->notes}}<h4>
                @endif
                <br>
                <a href="{{ route('pdfdetails',[$order->id,'download'=>'pdf']) }}" class="btn btn-info" role="button">Download PDF</a>
            </div>
        </div>
    </div>

    </section>
@endsection
