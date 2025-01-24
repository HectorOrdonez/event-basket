<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite('resources/css/app.css')
    <title>Event Basket</title>
</head>
<body>
<x-navbar/>
{{ $slot }}
</body>
</html>
