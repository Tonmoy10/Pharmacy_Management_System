
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
@extends('vendor.layouts.toplayout')
@section('content')
<body>
    <fieldset>
    <legend><h1>UPDATE SUPPLY ITEM </h1></legend>
    <form method="POST" action="">
        {{ csrf_field() }}
        Medicine Id : <input type="text" name="med_id" placeholder="{{$supply->med_id}}" value="{{$supply->med_id}}"readonly>
        <br>
        @error('med_id')
            {{ $message}}<br>
        @enderror
        <br>
        Medicine Name : <input type="text" name="med_name" placeholder="{{$supply->med_name}}" value="{{$supply->med_name}}"readonly>
        <br>
        @error('med_name')
            {{ $message}}<br>
        @enderror
        <br>
        Price per Unit : <input type="text" name="price_perUnit" placeholder="{{$supply->price_perUnit}}" value="{{$supply->price_perUnit}}">
        <br>
        @error('price_perUnit')
            {{ $message}}<br>
        @enderror
        <br>
        ADD Stock : <input type="number" name="stock" placeholder="Stock" value="{{old('stock')}}">
        <br>
        @error('stock')
            {{ $message}}<br>
        @enderror
        <br>
        Expiry Date : <input type="date" name="expiryDate" placeholder="{{$supply->expiryDate}}" value="{{$supply->expiryDate}}">
        <br>
        @error('expiryDate')
            {{ $message}}<br>
        @enderror
        <br>
        Manufacturing Date : <input type="date" name="manufacturingDate" placeholder="{{$supply->manufacturingDate}}" value="{{$supply->manufacturingDate}}">
        <br>
        @error('manufacturingDate')
            {{ $message}}<br>
        @enderror
        <br>
        <input type="submit" name="add" value="ADD">
    </form>
</fieldset>
@endsection
</body>

</html>