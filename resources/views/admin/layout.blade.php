<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta content="width=device-width, initial-scale=1.0" name="viewport">
      <title>Dashboard - Admin Bootstrap Template</title>
      <meta name="robots" content="noindex, nofollow">
      <meta content="" name="description">
      <meta content="" name="keywords">
      <link href="{{URL('admin/assets/img/favicon.png')}}" rel="icon">
      <link href="{{URL('admin/assets/img/apple-touch-icon.png')}}" rel="apple-touch-icon">
      <link href="https://fonts.gstatic.com" rel="preconnect">
      <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
      <link href="{{URL('admin/assets/css/bootstrap.min.css')}}" rel="stylesheet">
      <link href="{{URL('admin/assets/css/bootstrap-icons.css')}}" rel="stylesheet">
      <link href="{{URL('admin/assets/css/boxicons.min.css')}}" rel="stylesheet">
      <link href="{{URL('admin/assets/css/quill.snow.css')}}" rel="stylesheet">
      <link href="{{URL('admin/assets/css/quill.bubble.css')}}" rel="stylesheet">
      <link href="{{URL('admin/asstes/css/remixicon.css')}}" rel="stylesheet">
      <link href="{{URL('admin/assets/css/simple-datatables.css')}}" rel="stylesheet">
      <link href="{{URL('admin/assets/css/style.css')}}" rel="stylesheet">
   </head>
   <body>
        @include('admin.elements.header')
        @include('admin.elements.sidebar')
      <main id="main" class="main">
        @yield('content')
      </main>
      <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>  
        <script src="{{URL('admin/assets/js/apexcharts.min.js')}}"></script>
        <script src="{{URL('admin/assets/js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{URL('admin/assets/js/chart.min.js')}}"></script>
        <script src="{{URL('admin/assets/js/echarts.min.js')}}"></script>
        <script src="{{URL('admin/assets/js/quill.min.js')}}"></script>
        <script src="{{URL('admin/assets/js/simple-datatables.js')}}"></script>
        <script src="{{URL('admin/assets/js/tinymce.min.js')}}"></script>
        <script src="{{URL('admin/assets/js/validate.js')}}"></script>
        <script src="{{URL('admin/assets/js/main.js')}}"></script> 
             
   </body>
</html>