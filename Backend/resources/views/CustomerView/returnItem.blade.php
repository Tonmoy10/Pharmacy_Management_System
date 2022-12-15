@extends('CustomerLayout.top')
@section('content')
<title>Return Items</title>
    @foreach ($order as $delivered)
    <fieldset style="width:30%">
        OrderID: {{$delivered->order_id}} <br>
        Items: <br>
        <table style="border: 2px solid black;">
        @foreach ($delivered->orders_cart as $i)
            <tr>
                <td>{{$i->items}} </td>
                <form action="" method="POST">
                    {{ csrf_field() }}
                <td>
                    @if ($i->return_status=='false')
                        <input type="hidden" name="id" value={{$i->id}}>
                        <input type="submit" name="return" value="RETURN">
                    @elseif($i->return_status=='true')
                        #Return request under processing
                    @else
                        #Return request {{$i->return_status}}
                    @endif
                                
                </td>
            </form>
            </tr>
        @endforeach
        </table>
    </fieldset>
    <br><br>
    @endforeach
    <h5>{{$order->links('pagination::bootstrap-5')}}</h5>

@endsection