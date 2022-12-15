@extends('vendor.layouts.toplayout')
@section('content')
<body  bgcolor="#CCCCFF">
    <center>
        <fieldset>
        <legend>
            <h3>MODIFY ACCOUNT INFORMATION OF <label style="color:rgb(44, 41, 221)">{{Str::upper($vendor->vendor_name)}}</label></h3> 
        </legend>
        
    
        <form action="" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            USER ID : <input type="text" name="u_id" placeholder=" {{$vendor->users->u_id}}" value=" {{$vendor->users->u_id}} " readonly>
            <br><br>

            Name: <input type="text" name="name" placeholder="{{$vendor->vendor_name}}" value=" {{$vendor->vendor_name}} ">
            <br>
            @error('name')
                {{ $message}}<br>
            @enderror
            <br>
            Email: <input type="email" name="email" placeholder="{{$vendor->vendor_email}}" value=" {{$vendor->vendor_email}} " readonly>
            <br>
            @error('email')
                {{ $message}}<br>
            @enderror
            <br>
            Password: <input type="password" name="password" placeholder="Password" value="">
            <br>
            @error('password')
                {{ $message}}<br>
            @enderror
            <br>
            Confirm Password : <input type="password" name="confirmPassword" placeholder="Re-enter Password" value="">
            <br>
            @error('confirmPassword')
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
</body>
    
@endsection

