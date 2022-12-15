@extends('AllUserLayout.top')
<title>Forgot Password</title>
@section('content')
<center>
<fieldset style="width:40%">
    <form action="" method="post">
        {{ csrf_field() }}
        <br>
        Email <input type="text" name="u_email" value="{{old('u_email')}}" size="30"><br>
        @error('u_email')
            {{$message}}
        @enderror
        <br>       
        <br>
        <input type="submit" name="submit" value="Send Verification email">
    </form>    
</fieldset>
</center>
@endsection