<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="{{URL('assets/')}}"
  data-template="vertical-menu-template-free">

<head>
  <meta charset="utf-8" />
  <meta name="viewport"
    content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

  <title>@yield('title')</title>

  <meta name="description" content="HAB - Trắc Nghiêm" />
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- Favicon -->
  <link rel="icon" type="image/x-icon" href="{{URL('admin/assets/img/logo/ic_logo_hab.png')}}" />

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
    rel="stylesheet" />

  <!-- Icons. Uncomment required icon fonts -->
  <link rel="stylesheet" href="{{URL('admin/assets/vendor/fonts/boxicons.css')}}" />

  <!-- Core CSS -->
  <link rel="stylesheet" href="{{URL('admin/assets/vendor/css/core.css')}}" class="template-customizer-core-css" />
  <link rel="stylesheet" href="{{URL('admin/assets/vendor/css/theme-default.css')}}" class="template-customizer-theme-css" />
  <link rel="stylesheet" href="{{URL('admin/assets/css/demo.css')}}" />

  <!-- Vendors CSS -->
  <link rel="stylesheet" href="{{URL('admin/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css')}}" />

  <link rel="stylesheet" href="{{URL('admin/assets/vendor/libs/apex-charts/apex-charts.css')}}" />

  <!-- Page CSS -->

  <!-- Helpers -->
  <script src="{{URL('admin/assets/vendor/js/helpers.js')}}"></script>

  <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
  <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
  <script src="{{URL('admin/assets/js/config.js')}}"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

  
</head>

<body>
  <!-- Layout wrapper -->
  <div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">

        @include("admin.elements.aside")
      <!-- Layout container -->
      <div class="layout-page">
        @include("admin.elements.navbar")

        <!-- Content wrapper -->
        <div class="content-wrapper">
          
            @yield('content')
          <div class="content-backdrop fade"></div>
        </div>
        <!-- Content wrapper -->
      </div>
      <!-- / Layout page -->
    </div>

    <!-- Overlay -->
    <div class="layout-overlay layout-menu-toggle"></div>
  </div>
  <!-- / Layout wrapper -->


    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    

  <!-- Core JS -->
  <!-- build:js assets/vendor/js/core.js -->
  <script src="{{URL('admin/assets/vendor/libs/jquery/jquery.js')}}"></script>
  <script src="{{URL('admin/assets/vendor/libs/popper/popper.js')}}"></script>
  <script src="{{URL('admin/assets/vendor/js/bootstrap.js')}}"></script>
  <script src="{{URL('admin/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js')}}"></script>

  <script src="{{URL('admin/assets/vendor/js/menu.js')}}"></script>
  <!-- endbuild -->

  <!-- Vendors JS -->
  <script src="{{URL('admin/assets/vendor/libs/apex-charts/apexcharts.js')}}"></script>

  <!-- Main JS -->
  <script src="{{URL('admin/assets/js/main.js')}}"></script>

  <!-- Page JS -->
  <script src="{{URL('admin/assets/js/dashboards-analytics.js')}}"></script>

  <!-- Place this tag in your head or just before your close body tag. -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
</body>

</html>