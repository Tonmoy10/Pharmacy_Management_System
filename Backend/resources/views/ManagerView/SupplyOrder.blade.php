@extends('AllUserLayout.account')
@section('content')
<body bgcolor="#CCCCFF">
        <table border="1">
            <tr>
                <th>Vendor ID</th>
                <th>Medicine ID</th>
                <th>Medicine Name</th>
                <th>Stock</th>
                <th>Unit Price</th>
                <th>Quantity</th>
            </tr>
            @foreach ($val as $it)
            <tr>
                <form action="" method="post">
                {{ csrf_field() }}
                <td>{{$it->vendor_id}}</td>
                <td>{{$it->med_id}}</td>
                <td>{{$it->med_name}}</td>
                <td>{{$it->stock}}</td>
                <td>{{$it->price_perUnit}}</td>
                <td><input type="number" min=0 name="amount" placeholder="Add quantity" ></td>
                <td><input type="hidden" name="id" value="{{$it->supply_id}}"></td>
                <td><input type="submit" name="add" value="Add to Cart"></td>
                </form>
            </tr>
            @endforeach

        </table><br>
        <h3>{{Session::get('message')}}</h3>
        @error('amount')
            {{$message}} <br> <br>
        @enderror
    <form action="" method="post">
    {{ csrf_field() }}
        <input type="submit" name="add" value="View Items">
    </form>
</body>
@endsection
