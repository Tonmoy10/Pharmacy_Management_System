@extends('CustomerLayout.top')
@section('content')
<title>Medicine List</title>
    <h3>MEDICINE LIST</h3>
    <form action="" method="POST">
        {{csrf_field()}}
    <fieldset>
        Search by Name: <input type="text" name="search" value="{{old('search')}}"> 
        <input type="submit" name="add" value="SEARCH"> &nbsp; &nbsp; 

        <select name="filter" id="" value='Filter by'>
            <option value="">Filter</option>
            <optgroup label="Price :">
                <option value="ORDER BY PRICE HIGHEST TO LOWEST">High - Low</option>
                <option value="ORDER BY PRICE LOWEST TO HIGHEST">Low - High</option>
            </optgroup>
        </select>

        {{-- <input type="submit" name="add" value="ORDER BY PRICE HIGHEST TO LOWEST">   &nbsp; &nbsp;   
        <input type="submit" name="add" value="ORDER BY PRICE LOWEST TO HIGHEST">   &nbsp; &nbsp;    --}}
    </fieldset>
    </form>
    <br>
    <h4>
        @error('quantity')
            {{$message}} <br>
        @enderror
        <br>
        @if (count($meds)>0)
            <table border="1">
                <tr>
                    <th>Medicine Name</th>
                    <th>Price per Unit</th>
                    <th>Stock</th>
                    <th>Quantity</th>
                </tr>

                @foreach ($meds as $med)
                    <tr>
                        <td>{{ $med->med_name }}</td>
                        <td>{{ $med->price_perUnit }}</td>
                        @if ($med->Stock=='0')
                            <th>STOCK OUT</th>
                        @else
                        <td>{{ $med->Stock }}</td>
                        @endif
                        <form action="" method="POST">
                        {{csrf_field()}}
                        <td><input type="number" name="quantity" min=0 placeholder="Type quantity here" value=""></td>
                        <input type="hidden" name="Stock" value=" {{$med->Stock}} ">
                        <input type="hidden" name="med_id" value=" {{$med->med_id}} ">
                        <td><input type="submit" name="add" placeholder="" value="ADD TO CART"></td>
                        </form>
                    </tr>   
                @endforeach
            </table>
            <br>
            
            <br>
            <h5>{{$meds->links('pagination::bootstrap-5')}}</h5>
        </h4>
        @else
            <br> "NO MEDICINE FOUND" <br>
        @endif
        

    <a href="{{route('customer.show.cart')}}">SHOW CART</a>
@endsection
