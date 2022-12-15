@section('content')
    <div class="flex justify-center">
        <div class="w-4/12 bg-white p-6 rounded-lg">
            @if(session('status'))
            <div class="mb-6 bg-red-400 p-4 text-white text-center rounded-lg">
                {{session('status')}}
            </div>
            @endif
            <form action="{{route('login')}}" method="post">
                @csrf
                
                <div class="mb-4">
                    <label for="email" class="sr-only">Email</label>
                    <input type="email" name="email" id="email" placeholder="example@example.com" 
                    class="bg-gray-100 border-2 w-full p-3 rounded-lg @error('email') 
                    border-red-500 @enderror" value="{{old('email')}}">
                </div>
                @error('email')
                <div class="text-red-500 mt-1 text-sm">
                    {{$message}}
                </div>
                @enderror
                <div class="mb-4">
                    <label for="password" class="sr-only">Password</label>
                    <input type="password" name="password" id="password" placeholder="Password" 
                    class="bg-gray-100 border-2 w-full p-3 rounded-lg @error('password') 
                    border-red-500 @enderror" value="">
                </div>
                
                @error('password')
                <div class="text-red-500 mt-1 text-sm">
                    {{$message}}
                </div>
                @enderror
                <div class="mb-3">
                    <div class="flex items-center">
                        <input type="checkbox" name="remember" id="remember" class="mr-2">
                        <label for="remember">Remember Me</label>
                    </div>
                </div>
                <div>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-3 rounded font-medium w-full">Login</button>
                </div>
            </form>
        </div>
    </div>
@endsection