@extends('AllUserLayout.account')
@section('content')
<body bgcolor="#CCCCFF">
    <h3><u>Medicine Details</u></h3><br><br><br>
    <b>Medicine ID: </b>{{$val->med_id}} <br><br>
    <b>Name: </b>{{$val->med_name}} <br><br>
    <b>Manufacturing Date: </b>{{$val->manufacturingDate}} <br><br>
    <b>Expiry Date: </b>{{$val->expiryDate}} <br><br>
    <b>Unit Price: </b>{{$val->price_perUnit}} <br><br>
    <b>Stock: </b>{{$val->Stock}} <br><br>
    <b>Vendor ID: </b>{{$val->vendor_id}} <br><br>
    <b>Vendor Name: </b>{{$val->vendor_name}} <br><br>
    <b>Contract ID: </b>{{$val->contract_id}} <br><br>
</body>
@endsection