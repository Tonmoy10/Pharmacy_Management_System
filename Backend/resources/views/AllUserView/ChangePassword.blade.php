@extends('AllUserLayout.top')
<title>Change Password</title>
@section('content')
<center>
<fieldset style="width:40%">
    <form action="" method="post">
        {{ csrf_field() }}
        <br>
        Email: <input type="text" name="u_email" value="{{$email}}" size="30" readonly><br>
        @error('u_email')
            {{$message}} <br>
        @enderror
        <br>       
        New Password: <input type="password" value="" name="password" placeholder="New Password"><br>
        @error('password')
            {{$message}} <br>
        @enderror
        <br>
        Confirm Password: <input type="password" name="confirmPassword" placeholder="Confirm Password"><br>
        @error('confirmPassword')
            {{$message}}
        @enderror
        <br>
        <input type="submit" name="ChangePassword" value="Change Password">
    </form>    
</fieldset>
</center>
@endsection