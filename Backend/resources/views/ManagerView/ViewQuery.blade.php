@extends('AllUserLayout.account')
@section('content')
<h2><u>Query Information</u></h2>
<body bgcolor="#CCCCFF">
    @if(count($data)>0)
    <table border="1">
        <tr>
            <th>Order ID</th>
            <th>Medicine ID</th>
            <th>Medicine Name</th>
            <th>Quantity</th>
            <th>Return Status</th>
        </tr>
        @foreach ($data as $it)
        <tr>
            <td>{{$it->order_id}}</td>
            <td>{{$it->med_id}}</td>
            <td>{{$it->items}}</td>
            <td>{{$it->quantity}}</td>
            <td>{{$it->return_status}}</td>
            @if ($it->return_status=="true")
                <td><a href="{{route('query.accept',['id'=>$it->id])}}">Accept</td>
                <td><a href="{{route('query.deny',['id'=>$it->id])}}">Decline</td>
            @endif
        </tr>
        @endforeach

    </table>
    {{$data->links()}}
    @else
    <br> No Data!! <br>
    @endif
</body>
@endsection