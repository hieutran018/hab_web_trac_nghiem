<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta content="width=device-width, initial-scale=1.0" name="viewport">
      <title>@yield('title')</title>
      <meta name="robots" content="noindex, nofollow">
      <meta content="" name="description">
      <meta content="" name="keywords">
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <link href="{{URL('admin/assets/img/ic_logo_hab.png')}}" rel="icon">
      <link href="{{URL('admin/assets/img/ic_logo_hab.png')}}" rel="icon">
      <link href="https://fonts.gstatic.com" rel="preconnect">
      <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
      <link href="{{URL('admin/assets/css/bootstrap.min.css')}}" rel="stylesheet">
      <link href="{{URL('admin/assets/css/bootstrap-icons.css')}}" rel="stylesheet">
      <link href="{{URL('admin/assets/css/boxicons.min.css')}}" rel="stylesheet">
      <link href="{{URL('admin/assets/css/quill.snow.css')}}" rel="stylesheet">
      <link href="{{URL('admin/assets/css/quill.bubble.css')}}" rel="stylesheet">
      {{-- <link href="{{URL('admin/asstes/css/remixicon.css')}}" rel="stylesheet"> --}}
      <link href="{{URL('admin/assets/css/simple-datatables.css')}}" rel="stylesheet">
      <link href="{{URL('admin/assets/css/style.css')}}" rel="stylesheet">
      <script src="{{URL('admin/ajax/jquery-3.6.1.min.js')}}"></script>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.9/sweetalert2.min.css">
      <script src="{{URL('admin/assets/js/sweetalert.min.js')}}"></script>
      <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
      <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
  {{-- <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script> --}}
  <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/jquery.dataTables.min.js" integrity="sha512-BkpSL20WETFylMrcirBahHfSnY++H2O1W+UnEEO4yNIl+jI2+zowyoGJpbtk6bx97fBXf++WJHSSK2MV4ghPcg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/css/dataTables.bootstrap.min.css" integrity="sha512-BMbq2It2D3J17/C7aRklzOODG1IQ3+MHw3ifzBHMBwGO/0yUqYmsStgBjI0z5EYlaDEFnvYV7gNYdD3vFLRKsA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/css/dataTables.jqueryui.min.css" integrity="sha512-x2AeaPQ8YOMtmWeicVYULhggwMf73vuodGL7GwzRyrPDjOUSABKU7Rw9c3WNFRua9/BvX/ED1IK3VTSsISF6TQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/css/dataTables.bootstrap4.min.css" integrity="sha512-PT0RvABaDhDQugEbpNMwgYBCnGCiTZMh9yOzUsJHDgl/dMhD9yjHAwoumnUk3JydV3QTcIkNDuN40CJxik5+WQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />


      

    
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