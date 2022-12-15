@extends('CourierView.layouts.app')
@section('content')
    <h3>Profile {{Str::upper($courier->courier_name)}}</h3> 

    <h4>Delivery Amount {{$courier->due_delivery_fee}}</h4>
    <br><br>
    <a href="/courier/cashout"></a>
    <br><br>
    <form action="" method="POST">
        {{ csrf_field() }}
        User Id : <input type="text" name="u_id" placeholder=" {{$courier->u_id}}" value=" {{$courier->u_id}} " readonly>
        <br><br>
        Courier Id : <input type="text" name="courier_id" placeholder=" {{$courier->courier_id}}" value=" {{$courier->courier_id}} " readonly>
        <br><br>
        Name: <input type="text" name="name" placeholder="{{$courier->courier_name}}" value=" {{$courier->courier_name}} " readonly>
        <br><br>
        Available Amount: <input type="text" name="availableAmount" placeholder="{{$courier->due_delivery_fee}}" value=" {{$courier->due_delivery_fee}} " readonly>
        <br><br>
        Cashout amount: <input type="text" name="amount" placeholder="{{$courier->due_delivery_fee}}" value=" {{$courier->due_delivery_fee}} ">
        <br><br>
        @error('amount')
            {{ $message}}<br>
        @enderror
        <input type="submit" name="modify" value="Cashout">

        
    </form>
@endsection