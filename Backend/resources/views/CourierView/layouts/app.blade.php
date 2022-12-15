<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pharma</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
</head>
<body class="bg-gray-300">
    <nav class="p-6 bg-white flex justify-between mb-6">
        <ul class="flex items-center">
            <li>
                <a href="{{route('courier.home')}}" class="p-3">Home</a>
            </li>
            <li>
                <a href="{{route('courier.AcceptedOrder')}}" class="p-3">Accepted Orders</a>
            </li>
            <li>
                <a href="{{route('courier.order')}}" class="p-3">Orders</a>
            </li>
        </ul>
        <ul class="flex items-center">
            <li>
                <a href="{{route('courier.profile',['id'=>Session::get('name')])}}" class="p-3 capitalize">Profile</a>
            </li>
            <li>
                <form action="{{route('logout')}}" method="get" class="inline p-3">
                    @csrf
                    <button type="submit">Logout</button>
                </form>
                
            </li>
        </ul>
    </nav>
    @yield('content')
</body>
</html>