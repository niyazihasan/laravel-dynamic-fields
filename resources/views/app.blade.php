<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel 6.4.11</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="{{asset('js/dynamic-telephone-numbers.js')}}"></script>  
    </head>
    <style>.invalid-feedback{display: block;}</style>
    <body>
        <div class="container">
            @if(Session::has('success'))
            <div class="alert alert-success">     
                {{session('success')}}
            </div>
            @endif
            @yield('contacts.index')
            @yield('contacts.create')
            @yield('contacts.edit')
            @yield('contacts.show')
        </div>
    </body>
</html>