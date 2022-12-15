@extends('AllUserLayout.account')
@section('content')
<body bgcolor="#CCCCFF">
    @if(count($data)>0)
    <table border="1">
        <tr>
            <th>Medicine Id</th>
            <th>Name</th>
            <th>Manufacturing Date</th>
            <th>Expiry Date</th>
            <th>Unit Pirice</th>
            <th>Stock</th>
        </tr>
        @foreach ($data as $it)
        <tr>
            <td>{{$it->med_id}}</td>
            <td>{{$it->med_name}}</td>
            <td>{{$it->manufacturingDate}}</td>
            <td>{{$it->expiryDate}}</td>
            <td>{{$it->price_perUnit}}</td>
            <td>{{$it->Stock}}</td>
            <td><a href="{{route('med.info',['id'=>$it->med_id])}}">Details</td>
            <td><a href="{{route('med.delete',['id'=>$it->med_id])}}">Delete</td>
        </tr>
        @endforeach
    </table>
    {{$data->links()}}
    @else
    <br> No Data!! <br>
    @endif
</body>
@endsection
