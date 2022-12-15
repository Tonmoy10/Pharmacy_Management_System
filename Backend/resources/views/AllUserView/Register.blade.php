@extends('AllUserLayout.top')
<title>PHARMACY REGISTRATION</title>
@section('content')
<center>
    <h1>REGISTRATION FORM OF {{$type}}</h1>
    <fieldset style="width: 30%"> <br>
    <form method="POST" action="">
        {{ csrf_field() }}
        Name : <input type="text" name="name" placeholder="Name" value="{{old('name')}}">
        <br>
        @error('name')
            {{ $message}}<br>
        @enderror
        <br>
        Email : <input type="email" name="email" placeholder="Email" value="{{old('email')}}" >
        <br>
        @error('email')
            {{ $message}}<br>
        @enderror
        <br>
        Password : <input type="password" name="password" placeholder="Password" value="">
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
        <input type="submit" name="register" value="REGISTER">
    </form>
    </fieldset>
</center>
@endsection