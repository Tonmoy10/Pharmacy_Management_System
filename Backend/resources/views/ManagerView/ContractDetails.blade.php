@extends('AllUserLayout.account')
@section('content')
<body bgcolor="#CCCCFF">
    <h3><u>Contract Details</u></h3><br><br><br>
    <b>Contract ID: </b>{{$val->contract_id}} <br><br>
    <b>Vendor ID: </b>{{$val->vendor_id}} <br><br>
    <b>Quantity: </b>{{$val->quantity}} <br><br>
    <b>Total Price: </b>{{$val->total_price}} <br><br>
    <b>Accepted Time: </b>{{$val->accepted_time}} <br><br>
    <b>Delivery Time: </b>{{$val->delivery_time}} <br><br>
    <b>Contract Status: </b>{{$val->contract_status}} <br><br>
</body>
@endsection