@extends('AllUserLayout.account')
@section('content')
<body bgcolor="#CCCCFF">
    @if(count($data)>0)
    <table border="1">
        <tr>
            <th>Contract ID</th>
            <th>Vendor ID</th>
            <th>Contract Status</th>
            <th>Medicine Name</th>
        </tr>
        @foreach($data as $it)
            <tr>
                <td>{{$it->contract_id}}</td>
                <td>{{$it->vendor_id}}</td>
                <td>{{$it->contract_status}}</td>
                <td>{{$it->med_name}}</td>
                <td><a href="{{route('contract.info',['id'=>$it->contract_id])}}">Details</td> 
                    @if ($it->contract_status=="Accepted" || $it->contract_status=="Pending")
                        <td><a href="{{route('contract.delete',['id'=>$it->contract_id])}}">Cancel</td>
                    @else
                        <td></td>
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
