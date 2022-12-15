@extends('AllUserLayout.top')
<title>PHARMACY REGISTRATION</title>
@section('content')
<center>
<fieldset style="width: 30%">
    <h1>USER SELECTION</h1>
    <form method="POST" action="">
        {{ csrf_field() }}

        <input type="submit" name="type" value="VENDOR"> <br> <br>
        <input type="submit" name="type" value="MANAGER"> <br> <br>
        <input type="submit" name="type" value="COURIER"> <br> <br>
        <input type="submit" name="type" value="CUSTOMER"> <br> <br>

    </form>
</fieldset>
</center>
@endsection