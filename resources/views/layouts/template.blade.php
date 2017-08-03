<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>@yield('title')</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.5 -->
  {{ Html::style('http://fonts.googleapis.com/css?family=Orbitron') }}
  {{ Html::style('css/app.css') }}
  {{ Html::style('css/pace-theme-flash.css') }}

  <meta name="csrf-token" content="{{ csrf_token() }}">

</head>
<body>
@include('layouts.header')

@yield('content')

@include('layouts.footer')
@stack('js')
{{ Html::script('js/pace.min.js') }}
</body>
</html>
