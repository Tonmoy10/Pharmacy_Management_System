<html>
    <head>
        <a href="{{route('logout')}}">LOGOUT</a> <br>
        <a href="{{route('customer.change.pass')}}">CHANGE PASSWORD</a>
        
        <center><h2>PHARMACY</h2></center> 
        <h3>
            <center>
            <fieldset style="width:70%">
                <a href=" {{route('customer.home')}} ">HOME || </a>
                <a href=" {{route('customer.account',['name'=>Session::get('name')])}} ">ACCOUNT INFO || </a>
                <a href=" {{route('customer.show.cart')}} ">CART || </a>
                <a href="{{route('customer.show.med')}}">MEDICINE LIST || </a>
                <a href=" {{route('customer.show.order')}} ">SHOW ORDERS || </a>
                <a href=" {{route('customer.return')}} ">RETURN </a>
            </fieldset>
            </center>
        </h3>
    </head>
    <body>
        @yield('content')
    </body>
    <br> <br> <br>
    <h3>
        <center>
        <fieldset style="width:70%">
            <a href=" {{route('customer.complain')}} ">FILE A COMPLAIN </a>
        </fieldset>
        </center>
    </h3>
</html>