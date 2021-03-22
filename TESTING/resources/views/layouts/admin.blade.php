<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>test</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->

  <link rel="shortcut icon" href="{{ URL::asset('public/images/favicon.png')}}" sizes="32x32" type="image/x-icon">

  <link rel="stylesheet" href="{{ URL::asset('public/css/bootstrap.min.css')}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ URL::asset('public/css/font-awesome.min.css')}}">
  <link rel="stylesheet" href="{{ URL::asset('public/css/ionicons.min.css')}}">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css">
  <link rel="stylesheet" href="{{ URL::asset('public/css/AdminLTE.min.css')}}">
  <link rel="stylesheet" href="{{ URL::asset('public/css/_all-skins.min.css')}}">
  <link rel="stylesheet" href="{{ URL::asset('public/css/bootstrap3-wysihtml5.min.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.css" integrity="sha256-aa0xaJgmK/X74WM224KMQeNQC2xYKwlAt08oZqjeF0E=" crossorigin="anonymous" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs-3.3.7/jq-3.3.1/dt-1.10.18/af-2.3.3/b-1.5.6/cr-1.5.0/fc-3.2.5/fh-3.1.4/kt-2.5.0/r-2.2.2/rg-1.1.0/rr-1.2.4/sc-2.0.0/sl-1.3.0/datatables.min.css"/>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic"/>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
  <link href="{{ URL::asset('public/js/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}" rel="stylesheet"/>
    <link rel="stylesheet" href="{{ URL::asset('public/css/custom.css')}}">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    @include('admin.elements.header')
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
   @include('admin.elements.sidebar')
  </aside>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    @yield('content')
  </div>
  <footer class="main-footer">
    <div class="pull-right hidden-xs">

    </div>
    <strong>Copyright &copy; 2018-2019 .</strong> All rights reserved.
  </footer>


</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js"></script>
{{--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>--}}
{{--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>--}}
<script type="text/javascript" src="https://cdn.datatables.net/v/bs-3.3.7/jq-3.3.1/dt-1.10.18/af-2.3.3/b-1.5.6/cr-1.5.0/fc-3.2.5/fh-3.1.4/kt-2.5.0/r-2.2.2/rg-1.1.0/rr-1.2.4/sc-2.0.0/sl-1.3.0/datatables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>

{{--<script src="{{ URL::asset('public/js/jquery.min.js')}}"></script>--}}
{{--<script src="{{ URL::asset('public/js/bootstrap.min.js')}}"></script>--}}
{{--<script src="{{ URL::asset('public/js/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>--}}

{{--<script src="{{ URL::asset('public/js/jquery.dataTables.min.js')}}"></script>--}}
{{--<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>--}}
{{--<script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.jss"></script>--}}
{{--<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js"></script>--}}
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.jss"></script>--}}
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>--}}
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>--}}
{{--<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>--}}
{{--<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>--}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" integrity="sha256-Uv9BNBucvCPipKQ2NS9wYpJmi8DTOEfTA/nH2aoJALw=" crossorigin="anonymous"></script>

<script src="{{ URL::asset('public/js/jquery.slimscroll.min.js')}}"></script>

<script src="{{ URL::asset('public/js/fastclick.js')}}"></script>
<script src="{{ URL::asset('public/js/adminlte.min.js')}}"></script>
<script src="{{ URL::asset('public/js/demo.js')}}"></script>
<!--<script src="{{ URL::asset('public/js/ckeditor/ckeditor.js')}}"></script>-->
<script src="{{ URL::asset('public/js/bootstrap3-wysihtml5.all.min.js')}}"></script>


<script src="{{ URL::asset('public/js/custom.js')}}"></script>

<script src="{{ URL::asset('public/js/jquery.validate.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3/jquery.inputmask.bundle.js"></script>


<!-- page script -->

{{--<script type="text/javascript">--}}
{{--  $(document).ready(function() {--}}
{{--      $('#example1').DataTable({--}}
{{--          dom: 'Bfrtip',--}}
{{--      });--}}
{{--  });--}}
{{--</script>--}}
</body>
</html>



