<html>
    <head> 
        <h3>
            
            <button type="button" onclick="window.location='{{route('vendor.home')}}'">Home</button>
        
            <button type="button" onclick="window.location='{{route('vendor.profile')}}'">Profile</button>
            
            <button type="button" onclick="window.location='{{route('vendor.supply')}}'">Supply</button>
        
            <button type="button" onclick="window.location='{{route('vendor.market')}}'">Market</button>
        
            <button type="button" onclick="window.location='{{route('vendor.contracts')}}'">Contracts</button>
            <p align=Right><button type="button" onclick="window.location='{{route('logout')}}'">Logout</button></p>
            
        </h3>
       
    </head>
    <body bgcolor="#CCCCFF">
        @yield('content')
    </body>
    <br> <br> <br>
    
</html>