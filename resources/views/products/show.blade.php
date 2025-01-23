<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Event Basket</title>
</head>
<body>
<h1>Product page</h1>

<h5>Product Id: {{ $id }}</h5>
<h5>Product Name: {{ $name }}</h5>
</body>
</html>
