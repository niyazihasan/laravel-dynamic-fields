<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>LVersion: {{ app()->version() }}</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
</head>
<body>
@if($message = Session::get('success'))
    <div class="message">
        <p class="left"></p>
        <p class="right"></p>{{ $message }}
    </div>
@endif
<div class="container container-fluid h-100 text-dark">
    <div class="row justify-content-center align-items-center">
        <h1>@yield('title')</h1>
    </div>
    <hr/>
    @yield('contacts.index')
    @yield('contacts.create')
    @yield('contacts.edit')
    @yield('contacts.show')
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.2/dist/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.js"></script>
@yield('scripts')
</body>
</html>
