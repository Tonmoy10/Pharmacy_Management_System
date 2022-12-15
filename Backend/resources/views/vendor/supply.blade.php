<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

    @extends('vendor.layouts.toplayout')
    @section('content')
    <center><h2><label style="color:rgb(112, 30, 137)">SUPPLY</label></h2>

    <body>
        <table border="1">
            <tr>
                
                <th>Medicine Id</th>
                <th>Medicine Name</th>
                <th>Price per Unit</th>
                <th>Stock</th>
                <th>Manufacturing Date</th>
                <th>Expiry Date</th>
                {{-- <th>Vendor Id</th> --}}
            </tr>
            @foreach ($supp as $sup)
            <tr>
                
                <td>{{$sup->med_id}}</td>
                <td>{{$sup->med_name}}</td>
                <td>{{$sup->price_perUnit}}</td>
                <td>{{$sup->stock}}</td>
                <td>{{$sup->manufacturingDate}}</td>
                <td>{{$sup->expiryDate}}</td>
                {{-- <td>{{$sup->vendor_id}}</td> --}}
                <td><a href="{{route('vendor.updatesupply',['supply_id'=>$sup->supply_id])}}">Update</td>
                <td><a href="{{route('vendor.deletesupply',['supply_id'=>$sup->supply_id])}}">Delete</td> 
            </tr>
            @endforeach
    
        </table>
        
        <br>
        <button type="button" onclick="window.location='{{route('vendor.addsupply')}}'">Add</button>

    </body>
</center>
{{$supp->links()}}
    
    @endsection 

    

</html>