@extends('CustomerLayout.top')
@section('content')
<title>Orders</title>
    <h3>CART LIST</h3>
    <fieldset style="width:30%">
        <legend> <b>{{Session::get('name')}}</b></legend>
        USER ID: {{Session::get('logged.customer')}} <br>
        CUSTOMER ID : {{Session::get('customer_id')}}
    </fieldset>
    <br><br><br>
    @if ($orders->count()>0)
        <table border="1">
            <tr>
                <th></th>
                <th>OrderID</th>
                <th>ORDER STATUS</th>
                <th>BILL(D.C inclusive)</th>
                <th>ACCEPTED TIME</th>
                <th>DELIVERY TIME</th>
                <th>ORDER ITEMS</th>
            </tr>
            @foreach ($orders as $order)
            <tr>
                @if ($order->order_status=='pending')
                    <td><a href="{{route('customer.order.cancel',['order_id'=>$order->order_id])}}">CANCEL ORDER</a></td>                               
                @else       
                    <td></td>                        
                @endif
                <td> {{$order->order_id}} </td>   
                <td> {{$order->order_status}} </td>
                <td> ${{$order->totalbill +$order->delivery_charge}} </td>
                <td> {{$order->accepted_time}} </td>
                <td> {{$order->delivery_time}} </td>
                <td> <a href="{{route('customer.order.details',['order_id'=>$order->order_id])}}">VIEW ITEMS ↓</a></td>

            </tr>
            @endforeach
        </table>
        <h5>{{$orders->links('pagination::bootstrap-5')}}</h5>
        <br><br>

    @else
        <br><br>
        <h3>NO ORDER HAS BEEN PLACED!</h3>
    @endif
@endsection