@extends('vendor.layouts.toplayout')
@section('content')
    <center><h2><label style="color:rgb(112, 30, 137)">CONTRACTS</label></h2>
    <table border="1">
        <tr>
            
            <th>contract_id</th>
            <th>Manager ID</th>
            <th>Total Price</th>
            <th>Contract Status</th>
            <th>Details</th>
        </tr>
        @foreach ($contract as $con)
        <tr>
            
            <td>{{$con->contract_id}}</td>
            <td>{{$con->manager_id}}</td>
            <td>{{$con->total_price}}</td>
            <td>{{$con->contract_status}}</td>
            <td><a href="{{route('vendor.contractdetails',['contract_id'=>$con->contract_id])}}">VIEW ITEMS </a></td> 

        </tr>
        @endforeach

    </table>
    <br>
</center>

@endsection
