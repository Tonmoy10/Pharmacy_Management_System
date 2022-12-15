@extends('CustomerLayout.top')
@section('content')
<title>Checkout</title>
    <center>
        <fieldset style="width: 60%">
            <legend><h3>CHANGE PASSWORD</h3></legend>
            <h4>
                <form action="" method="POST">
                    {{ csrf_field() }}

                    @if ($time!=NULL)
                        Password last updated at {{$time}}
                        
                    <br>
                    <br>
                    @endif
                    
                    

                    Email: <input type="email" size="30" name="email" placeholder="{{$customer->customer_email}}" value=" {{$customer->customer_email}} " readonly>
                    <br>
                    @error('email')
                        {{ $message}}<br>
                    @enderror
                    <br>
                    Current Password: <input type="password" name="c_password" placeholder="Current Password" value="{{old('c_password')}}">
                    <br>
                    @error('c_password')
                        {{ $message}}<br>
                    @enderror
                    <br>
                    New Password: <input type="password" name="password" placeholder="New Password" value="">
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
                    <input type="submit" name="changePass" value="CHANGE PASSWORD"> 
                </form>
            </h4>
        </fieldset>
        <b>{{Session::get('msg')}}</b>
    </center>
@endsection