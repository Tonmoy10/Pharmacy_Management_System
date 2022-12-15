@extends('CustomerLayout.top')
@section('content')
<title>Checkout</title>
    <center>
        <fieldset>
            <legend><h3>ORDER DETAILS</h3></legend>
            <h4>
                YOUR ORDER HAS BEEN PLACED!
                <br>
                ORDER-ID# {{$order->order_id}}
            </h4>
        </fieldset>
    </center>
@endsection