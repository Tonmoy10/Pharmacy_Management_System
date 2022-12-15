@extends('CustomerLayout.top')
@section('content')
<title>Account</title>
<center>
<fieldset style="width:30%">
    <legend><h3>ACCOUNT INFORMATION OF {{Str::upper($customer->customer_name)}}</h3></legend> 

    <h4>
        {{-- <img src="{{ asset("storage/profilepictures/".Session::get('logged.customer').".jpg")}}" alt="" srcset="" height="150" width="120"> --}}
        @if ($customer->img==NULL)
            
        @else
            <img src="{{ asset("storage/profilepictures/".$customer->img)}}" alt="" srcset="" height="150" width="120">           
        @endif
        
        <br>
        NAME : {{ $customer->customer_name }}
        <br>
        CUSTOMER ID : {{ $customer->customer_id }}
        <br>
        USER ID: {{$customer->users->u_id}}
        <br>
        EMAIL : {{ $customer->customer_email }}
    </h4>
    <br>
</fieldset>
</center>
    <h3><a href=" {{route('customer.modify.account',['name'=>Session::get('name')])}} ">UPDATE PROFILE INFORMATION</a></h3>
@endsection