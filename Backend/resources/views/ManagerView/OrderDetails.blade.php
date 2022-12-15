@extends('AllUserLayout.account')
@section('content')
<body bgcolor="#CCCCFF">
    <h3><u>Order Details</u></h3><br><br><br>
    <b>Order ID: </b>{{$val->order_id}} <br><br>
    <b>Customer ID: </b>{{$val->customer_id}} <br><br>
    {{-- <b>Customer Name: </b>{{$val->manufacturingDate}} <br><br> --}}
    <b>Total Price: </b>{{$val->totalbill}} <br><br>
    <b>Order Status: </b>{{$val->order_status}} <br><br>
    <b>Accepted Time: </b>{{$val->accepted_time}} <br><br>
    <b>Delivery Time: </b>{{$val->delivery_time}} <br><br>
</body>
@endsection