@extends('AllUserLayout.account')
@section('content')
<body bgcolor="#CCCCFF">
    <h3><u>User Details</u></h3><br><br><br>
    @if ($val->u_type=="CUSTOMER")
        <b>Personal ID: </b>{{$val->customer[0]->customer_id}} <br><br>
    @elseif ($val->u_type=="VENDOR")
        <b>Personal ID: </b>{{$val->vendor[0]->vendor_id}} <br><br>
    @elseif ($val->u_type=="COURIER")
        <b>Personal ID: </b>{{$val->courier[0]->courier_id}} <br><br>
    @elseif ($val->u_type=="MANAGER")
        <b>Personal ID: </b>{{$val->manager[0]->manager_id}} <br><br>
    @endif
    <b>User ID: </b>{{$val->u_id}} <br><br>
    <b>Name: </b>{{$val->u_name}} <br><br>
    <b>Email: </b>{{$val->u_email}} <br><br>
    <b>User Type: </b>{{$val->u_type}} <br><br>
</body>
@endsection