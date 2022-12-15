@extends('CustomerLayout.top')
@section('content')
<title>Modify Information</title>
<center>
    <h3>MODIFY ACCOUNT INFORMATION OF {{Str::upper($customer->customer_name)}}</h3> 
    <fieldset style="width: 60%">
    <form action="" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
        USER ID : <input type="text" name="u_id" placeholder=" {{$customer->users->u_id}}" value=" {{$customer->users->u_id}} " readonly>
        <br><br>
        CUSTOMER ID : <input type="text" name="customer_id" placeholder=" {{$customer->customer_id}}" value=" {{$customer->customer_id}} " readonly>
        <br><br>
        Email: <input type="email" name="email" size="30" placeholder="{{$customer->customer_email}}" value=" {{$customer->customer_email}} " readonly>
        <br>
        @error('email')
            {{ $message}}<br>
        @enderror
        <br>
        Name: <input type="text" name="name" placeholder="{{$customer->customer_name}}" value=" {{$customer->customer_name}} ">
        <br>
        @error('name')
            {{ $message}}<br>
        @enderror
        <br>
        <input type="file" name="profilepic">
        @error('profilepic')
            {{ $message}}<br>
        @enderror
        <br><br>
        <input type="submit" name="modify" value="MODIFY">

        
    </form>
    </fieldset>
</center>
@endsection