@extends('CustomerLayout.top')
@section('content')
<title>File a complain</title>
<center>
<fieldset style="width:50%">
    <legend>File a complain</legend>
    <form action="" method="POST">
        {{ csrf_field() }}
        Name: <input type="text" name="name" value="{{Session::get('name')}}" readonly> <br> <br>
        UserId: <input type="text" name="id" value="{{Session::get('logged.customer')}}" readonly><br><br>
        CustomerId: <input type="text" name="customer_id" value="{{Session::get('customer_id')}}" readonly><br><br>
        Email from: <input type="text" name="email" value="{{Session::get('email')}}" readonly> <br><br>
        Write your message here: <br>
        <textarea name="msg" id="" cols="40" rows="10" placeholder="SPECIFY ORDER-ID#"></textarea><br><br>
        <input type="submit" name="submit" value="SEND">
    </form>
</fieldset>
<br>
{{Session::get('emailsent')}}
</center>
   
@endsection