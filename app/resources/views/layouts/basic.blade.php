<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Post!-Post!-Post! - @yield('title') </title>
  <!-- Bootstrap -  app.css は style.css より上に書く -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <script src="{{ asset('js/app.js') }}"></script>
  <!-- CSS -->
  <link href="{{ asset('css/style.css') }}" rel="stylesheet">
  <!-- Fontawesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css" integrity="sha384-vp86vTRFVJgpjF9jiIGPEEqYqlDwgyBgEF109VFjmqGmIY/Y4HV4d3Gp2irVfcrp" crossorigin="anonymous">
</head>
<body>
  
  <!-- Header -->
  <header class="shadow">
    <div class="title">Post!-Post!-Post!</div>
  </header>
  
  <div class="d-flex maincontainer">
    @yield('sidebar')
    @yield('main')
    @yield('right')
  </div>

    @yield('jsfiles')
 
</body>
</html>