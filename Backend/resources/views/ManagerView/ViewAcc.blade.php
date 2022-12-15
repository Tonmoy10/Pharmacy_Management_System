@extends('AllUserLayout.account')
@section('content')
<body bgcolor="#CCCCFF">
    @if(count($data)>0)
    <table border="1">
        <tr>
            <th>Serial</th>
            <th>Date</th>
            <th>Expenses</th>
            <th>Revenue</th>
        </tr>
        @foreach ($data as $it)
        <tr>
            <td>{{$it->serial}}</td>
            <td>{{$it->date}}</td>
            <td>{{$it->expenses}}</td>
            <td>{{$it->revenue}}</td>
        </tr>
        @endforeach
    </table>
    {{$data->links()}}
    @else
    <br> No Data!! <br>
    @endif
</body>
@endsection
