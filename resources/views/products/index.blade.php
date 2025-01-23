<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Event Basket</title>
</head>
<body>
<h1>Event Basket</h1>
<form method="post" action="{{ route('products.store') }}">
    @csrf
    <label for="name">Product name</label>
    <input type="text" name="name" id="name" value="name" style="color: black"/>
    <button type="submit" style="background-color: #ff2d20">Add Product</button>
</form>

</body>
</html>
