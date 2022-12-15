@extends('AllUserLayout.account')
@section('content')
<body bgcolor="#CCCCFF">
<h3>{{Session::get('ms')}}</h3>
    <form action="" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <h2><u>Change Information</u></h2><br><br>
        Name : <input type="text" readonly placeholder="Name" value="{{session()->get('manager.name')}}"><br><br>
        Email : <input type="text" readonly name="email" placeholder="Email" value="{{session()->get('manager.email')}}"><br><br>
        Current Password: <input type="password" name="password" placeholder="Password" ><br><br>
        @error('password')
        {{$message}} <br> <br>   
        @enderror
        New Password : <input type="password" name="newPassword" placeholder="Password" ><br><br>
        @error('newPassword')
        {{$message}} <br> <br>
        @enderror
        Confirm Password : <input type="password" name="confirmPassword" placeholder="Re-enter Password" ><br><br>
        @error('confirmPassword')
        {{$message}} <br> <br>
        @enderror
    
        <input type="file" name="propics"> <br><br>
    
        <input type="submit" name="sub" value="Confirm">
    </form>
    
</body>
@endsection