<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Test</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  
  <link rel="shortcut icon" href="{{ URL::asset('public/images/favicon.png')}}" sizes="32x32" type="image/x-icon">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{ URL::asset('public/css/main.css')}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ URL::asset('public/css/custom.css')}}">
 
</head>
<body class="hold-transition skin-blue sidebar-mini">
@include('front.elements.header-home')

    @yield('content')
  
@include('front.elements.footer-home')






  
<!-- jQuery 3 -->
<script src="{{ URL::asset('public/js/jquery.min.js')}}"></script>
<script src="{{ URL::asset('public/js/popper.min.js')}}"></script>
<script src="{{ URL::asset('public/js/bootstrap.min.js')}}"></script>

<!-- page script -->
</body>
</html>
