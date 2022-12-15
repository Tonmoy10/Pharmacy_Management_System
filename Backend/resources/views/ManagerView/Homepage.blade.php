@extends('ManagerLayout.Search')
@section('cont')
@if ($manager->image==NULL)

@else
    <img src="{{ asset("storage/propics/".$manager->image)}}" alt="" srcset="" height="150" width="150">
@endif
<h2>Hello, {{Session::get('name')}}</h2>
<center>
    <body bgcolor="#CCCCFF">
    <fieldset style= "width: 360px">
            <legend style="text-align:center"><h2>Available Actions</h2></legend><br><br>
        <form action="" method="post">
            {{ csrf_field() }}
            <input type='submit' name='action' value='View Users'> &nbsp; &nbsp;
            <input type='submit' name='action' value='View Medicine'> &nbsp; &nbsp;
            <input type='submit' name='action' value='View Orders'> &nbsp; &nbsp;<br><br><br><br><br>
            <input type='submit' name='action' value='View Contracts'> &nbsp; &nbsp;
            <input type='submit' name='action' value='View Supply'> &nbsp; &nbsp;
            <input type='submit' name='action' value='Go to Cart'> &nbsp; &nbsp;<br><br><br><br><br>
            <input type='submit' name='action' value='View Query'>&nbsp;&nbsp; 
            &nbsp;<input type='submit' name='action' value='View Account'><br><br>
        </form>
    </fieldset>
    </body>
    </center>
@endsection



