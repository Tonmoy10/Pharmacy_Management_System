<head>
    <h5>
    <a href="{{route('logout')}}">LOGOUT</a> &nbsp;||&nbsp;
    {{-- <a href="{{url()->previous()}}">BACK</a> &nbsp;||&nbsp; --}}
    <a href="{{route('manager.home')}}">HOME</a> &nbsp;||&nbsp;
    <a href="{{route('manager.profile')}}">PROFILE</a> <br>
    </h5><br>
</head>
<form action="" method="post">
    {{ csrf_field() }}
    <fieldset>
        <legend style="text-align:center">Search Bar</legend>
        <center>
            Search in table: <br>
            <select name="search" placeholder="Search in table">
                <option value="user">User</option>
                <option value="medicine">Medicine</option>
                <option value="contract">Contract</option>
                <option value="order">Order</option>
                <option value="supply">Supply</option>
            </select>
            <br>
            Search Here:- <br>
            <input type="text" name="searchBar" placeholder="Search by id"> <br>
            @error('searchBar')
                {{$message}} <br>
            @enderror
            <input type="submit" name="action" value="Search">
        </center>
    </fieldset>
</form>
<body>
    @yield('cont')
</body>