@extends('CourierView.layouts.app')

@section('content')
<table border="1">
    <tr>
        <th>Order Id</th>
        <th>Cart Id</th>
        <th>Customer Id</th>
        <th>Order Status</th>
        <th>Delivery Time</th>
        <th>Accept</th>
    </tr>
    @foreach ($orders as $order)
    <tr>
        <td>{{$order->order_id}}</td>
        <td>{{$order->cart_id}}</td>
        <td>{{$order->customer_id}}</td>
        <td>{{$order->order_status}}</td>
        <td>{{$order->delivery_time}}</td>
        @if ($order->order_status=='pending')
        <td><a href="{{route('order.accept',['order_id'=>$order->order_id])}}">Accept</a></td>
        @endif

    </tr>
    @endforeach
    <h5>{{$orders->links('pagination::bootstrap-5')}}</h5>
</table>
@endsection