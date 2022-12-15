@extends('AllUserLayout.account')
@section('content')
<body bgcolor="#CCCCFF">
    @if(count($data)>0)
    <table border="1">
        <tr>
            <th>Order ID</th>
            <th>Customer ID</th>
            <th>Total Price</th>
            <th>Order Status</th>
        </tr>
        @foreach ($data as $it)
        <tr>
            <td>{{$it->order_id}}</td>
            <td>{{$it->customer_id}}</td>
            <td>{{$it->totalbill}}</td>
            <td>{{$it->order_status}}</td>
            <td>{{$it->price_perUnit}}</td>
            <td><a href="{{route('order.info',['id'=>$it->order_id])}}">Details</td>
        </tr>
        @endforeach

    </table>
    {{$data->links()}}
    @else
    <br> No Data!! <br>
    @endif
</body>
@endsection
