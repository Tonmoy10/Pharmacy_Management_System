
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
<body bgcolor="#CCCCFF">
    <fieldset>
    <legend><h1>ADD SUPPLY ITEM </h1></legend>
    <form method="POST" action="">
        {{ csrf_field() }}
        Medicine Id : <input type="text" name="med_id" placeholder="Medicine Id" value="{{old('med_id')}}">
        <br>
        @error('med_id')
            {{ $message}}<br>
        @enderror
        <br>
        Medicine Name : <input type="text" name="med_name" placeholder="Medicine Name" value="{{old('name')}}">
        <br>
        @error('med_name')
            {{ $message}}<br>
        @enderror
        <br>
        Price per Unit : <input type="text" name="price_perUnit" placeholder="Price per Unit" value="{{old('price_perUnit')}}">
        <br>
        @error('price_perUnit')
            {{ $message}}<br>
        @enderror
        <br>
        Stock : <input type="number" name="stock" placeholder="Stock" value="{{old('stock')}}">
        <br>
        @error('stock')
            {{ $message}}<br>
        @enderror
        <br>
        Expiry Date : <input type="date" name="expiryDate" placeholder="Expiry Date" value="{{old('expiryDate')}}">
        <br>
        @error('expiryDate')
            {{ $message}}<br>
        @enderror
        <br>
        Manufacturing Date : <input type="date" name="manufacturingDate" placeholder="Manufacturing Date" value="{{old('manufacturingDate')}}">
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