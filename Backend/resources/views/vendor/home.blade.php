<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
</head>
<center><h1>VENDOR</h1></center>
<body bgcolor="#CCCCFF">
    <br><br><br><br><br><br><br><br><br><br><br><br>
    
     
    <center>
        <fieldset style= "width: 360px" >
        <button type="button" onclick="window.location='{{route('vendor.home')}}'">Home</button>
        <br><br>
        <button type="button" onclick="window.location='{{route('vendor.profile')}}'">Profile</button>
        <br><br>
        <button type="button" onclick="window.location='{{route('vendor.supply')}}'">Supply</button>
        <br><br>
        <button type="button" onclick="window.location='{{route('vendor.market')}}'">Market</button>
        <br><br>
        <button type="button" onclick="window.location='{{route('vendor.contracts')}}'">Contracts</button>
        
        
    </center>

    <br><br><br><br>
    <br><br><br><br>
    <a href="{{route('logout')}}">LOGOUT</a>

    
</body>

</html>