<!DOCTYPE html>
<html>
    <head>
        <title>Laravel</title>
        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
    </head>
    <body>
        <h1>LARAVEL</h1>
        @foreach($fruits as $fruit)
        <li>{{ $fruit }}</li>
        @endforeach
    </body>
</html>
