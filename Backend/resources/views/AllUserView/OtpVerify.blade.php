@extends('AllUserLayout.top')
<title>Verify</title>
@section('content')
<center>
<fieldset style="width:40%">
    <form action="" method="post">
        {{ csrf_field() }}
        <br>
        Email: <input type="text" name="u_email" value="{{$email}}" size="30" readonly><br>
        @error('u_email')
            {{$message}}
        @enderror
        <br>       
        <br><br>
        <input type="text" name="code" maxlength="6" size="35" placeholder=" Enter the 6 digit code sent to your email "> <br> <br>
        @error('code')
            {{$message}} <br>
        @enderror
        <input type="submit" name="submit" value="Verify">
    </form>    
</fieldset>
{{Session::get('msg')}}
</center>
@endsection