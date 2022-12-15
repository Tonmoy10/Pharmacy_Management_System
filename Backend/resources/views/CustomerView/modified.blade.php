@extends('CustomerLayout.top')
@section('content')
<title>Modified Information</title>
    <h3>ACCOUNT INFORMATION OF {{Str::upper($customer->customer_name)}}</h3> 

    <h4>
        NAME : {{ $customer->customer_name }}
        <br>
        CUSTOMER ID : {{ $customer->customer_id }}
        <br>
        USER ID: {{$customer->users->u_id}}
        <br>
        EMAIL : {{ $customer->customer_email }}
    </h4>
    <br>
    <h3><a href=" {{route('customer.modify.account',['name'=>Session::get('name')])}} ">UPDATE PROFILE INFORMATION</a></h3>
@endsection