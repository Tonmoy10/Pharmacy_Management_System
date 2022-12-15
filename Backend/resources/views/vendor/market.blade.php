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
    <center><h2><label style="color:rgb(112, 30, 137)">MARKET</label></h2>
    <body bgcolor="#CCCCFF">
        <table border="1">
            <tr>
                <th>Supply Id</th>
                <th>Medicine Id</th>
                <th>Medicine Name</th>
                <th>Price per Unit</th>
                <th>Stock</th>
                <th>Manufacturing Date</th>
                <th>Expiry Date</th>
                
            </tr>
            @foreach ($supp as $sup)
            <tr>
                <td>{{$sup->supply_id}}</td>
                <td>{{$sup->med_id}}</td>
                <td>{{$sup->med_name}}</td>
                <td>{{$sup->price_perUnit}}</td>
                <td>{{$sup->stock}}</td>
                <td>{{$sup->manufacturingDate}}</td>
                <td>{{$sup->expiryDate}}</td>
                
            </tr>
        
            @endforeach
    
        </table>
        <br>
        

    </body>

    </center>
    @endsection 

    

</html>