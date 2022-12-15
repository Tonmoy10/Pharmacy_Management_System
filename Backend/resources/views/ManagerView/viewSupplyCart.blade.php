@extends('AllUserLayout.account')
@section('content')
<body bgcolor="#CCCCFF">
    <h2><u>Cart Information</u></h2>
    @if(count($data)>0)
    <table border="1">
        <tr>
            <th>Cart ID</th>
            <th>Vendor ID</th>
            <th>Medicine ID</th>
            <th>Medicine Name</th>
            <th>Unit Price</th>
            <th>Quantity</th>
            <th>Total Price</th>
        </tr>
        @foreach ($data as $it)
        <tr>
            <td>{{$it->cart_id}}</td>
            <td>{{$it->vendor_id}}</td>
            <td>{{$it->med_id}}</td>
            <td>{{$it->med_name}}</td>
            <td>{{$it->price_perUnit}}</td>
            <td>{{$it->quantity}}</td>
            <td>{{$it->total_price}}</td>
            {{-- <td>{{($it->stock*$it->price_perUnit)}}</td> --}}
            <td><a href="{{route('manager.removeCart',['id'=>$it->cart_id])}}">Remove</td>
        </tr>
        @endforeach
    </table><br><br><br><br>
    {{$data->links()}}
    Grand Total = Tk. {{$total}} <br><br>
    <form action="" method="post">
        {{ csrf_field() }}
        <input type="submit" name="confirm" value="Confirm Order">
    </form>
    @else
    <br> Empty Cart!! <br>
    @endif
</body>
@endsection
