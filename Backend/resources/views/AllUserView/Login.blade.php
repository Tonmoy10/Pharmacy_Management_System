<title>PHARMACY LOGIN</title>
@extends('AllUserLayout.top')
@section('content')
<center>
<fieldset style="width: 30%">
    <legend>
        <h1>LOG IN</h1>
    </legend>
        <form method="POST" action="">
            {{ csrf_field() }}
            Email: <input type="email" name="email" placeholder="Email" value="">
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
            <input type="submit" name="login" value="LOG IN">
        </form>
        <br>
    <a href="{{route('user.forgot.password')}}">FORGOT PASSWORD?</a>    
</fieldset>
<h3>{{Session::get('msg')}}</h3>

</center>
   
@endsection
