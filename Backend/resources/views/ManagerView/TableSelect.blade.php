{{-- {{ url()->previous() }} --}}
@extends('AllUserLayout.account')
@section('content')
<form action="" method="post">
    {{ csrf_field() }}
    <body bgcolor="#CCCCFF">
        <h3>Which table do you want to see?</h3>
        <input type='submit' name='user' value='Manager'> &nbsp; &nbsp;
        <input type='submit' name='user' value='Courier'> &nbsp; &nbsp;
        <input type='submit' name='user' value='Vendor'> &nbsp; &nbsp;
        <input type='submit' name='user' value='Customer'> &nbsp; &nbsp;


        {{-- <input type="radio" name="user" value="Manager">Manager
        <input type="radio" name="user" value="Courier">Courier
        <input type="radio" name="user" value="Vendor">Vendor
        <input type="radio" name="user" value="Customer">Customer<br>
        <input type="submit" value="Next"> --}}
    </body>
</form>
@endsection
