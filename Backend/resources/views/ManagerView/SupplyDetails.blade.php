@extends('AllUserLayout.account')
@section('content')
<body bgcolor="#CCCCFF">
    <h3><u>Supply Details</u></h3><br><br><br>
    <b>Vendor ID: </b>{{$val->vendor_id}} <br><br>
    <b>Medicine ID: </b>{{$val->med_id}} <br><br>
    {{-- <b>Customer Name: </b>{{$val->manufacturingDate}} <br><br> --}}
    <b>Medicine Name: </b>{{$val->med_name}} <br><br>
    <b>Stock: </b>{{$val->stock}} <br><br>
    <b>Manufacturing Date: </b>{{$val->manufacturingDate}} <br><br>
    <b>Expiry Date: </b>{{$val->expiryDate}} <br><br>
    <b>Unit Price: </b>{{$val->price_perUnit}} <br><br>
</body>
@endsection