@extends('AllUserLayout.account')
@section('content')
<body bgcolor="#CCCCFF">
    <h3><u>Profile Details</u></h3><br><br><br>

    <b>User ID: </b>{{$val->u_id}} <br><br>
    <b>Name: </b>{{$val->u_name}} <br><br>
    <b>Email: </b>{{$val->u_email}} <br><br>
    <b>User Type: </b>{{$val->u_type}} <br><br>
    <form action="" method="post">
        {{ csrf_field() }}
        <input type="submit" name="edit" value="Edit">
    </form>
</body>
@endsection