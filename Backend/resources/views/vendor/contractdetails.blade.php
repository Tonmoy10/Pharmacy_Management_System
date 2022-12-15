@extends('vendor.layouts.toplayout')
@section('content')
<center><h2><label style="color:rgb(112, 30, 137)">CONTRACT DETAILS with {{Str::upper($manager_name)}}</h3> </legend> </label></h2>
Contract ID : {{$contract[0]->contract_id}}

<table border="1">
    <tr>
        <th>medicine Name</th>
        <th>Quantity</th>
    </tr>
    @foreach ($contract as $con)
    <tr>
        <td>{{$con->med_name}}</td>
        <td>{{$con->quantity}}</td>
    </tr>
    @endforeach
</table>
Total Price :  {{$contract[0]->total_price}}
<br><br>
<form method="POST" action="">
{{ csrf_field() }}
Status :
<select name="status" value='{{$con->contract_status}}' placeholder="{{$con->contract_status}}">
    @if ($con->contract_status=='Pending')
        <option value="Pending">PENDING</option>
        <option value="Accept">ACCEPT</option>
        <option value="Reject">REJECT</option>
        </select>
        <input type="submit" name="update" value="update">
    @elseif($con->contract_status=='Reject')
        <option value="Reject">REJECT</option>
        </select> 
      
    @elseif($con->contract_status=='Accept')
        <option value="Accept">ACCEPT</option>
        </select>
    @endif
</form>
    
</center>
@endsection