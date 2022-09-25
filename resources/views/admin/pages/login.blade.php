<!DOCTYPE html>
<html
  lang="en"
  class="light-style customizer-hide"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="{{URL('admin/assets/')}}"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>Đăng nhập Admin | HAB - Trắc Nghiệm Vui </title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{URL('admin/assets/img/logo/ic_logo_hab.png')}}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="{{URL('admin/assets/vendor/fonts/boxicons.css')}}" />
    <script src="{{URL('admin/assets/js/jquery-3.6.1.min.js')}}"></script>

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{URL('admin/assets/vendor/css/core.css')}}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{URL('admin/assets/vendor/css/theme-default.css')}}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{URL('admin/assets/css/demo.css')}}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{URL('admin/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css')}}" />

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="{{URL('admin/assets/vendor/css/pages/page-auth.css')}}" />
    <!-- Helpers -->
    <script src="{{URL('admin/assets/vendor/js/helpers.js')}}"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{URL('admin/assets/js/config.js')}}"></script>
  </head>

  <body>
    <!-- Content -->

    <div class="container-xxl">
      <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">
          <div class="card">
            <div class="card-body">
              <!-- Logo -->
              <div class="app-brand justify-content-center">
                <a href="index.html" class="app-brand-link gap-2">
                  <span class="app-brand-logo demo">
                    <img src="{{URL('admin/assets/img/logo/ic_logo_hab.png')}}" alt="" width="25">
                  </span>
                  <span class="app-brand-text demo text-body fw-bolder">HAB</span>
                </a>
              </div>
              <!-- /Logo -->
              <h4 class="mb-2">Chào mừng bạn trở lại! 👋</h4>
              <p class="mb-4">Vui lòng nhập email và mật khẩu để đăng nhập.</p>

              <form id="formAuthentication" class="mb-3" action="{{Route('login-admin')}}" method="POST">
                @csrf
                <div class="mb-3">
                  <label for="email" class="form-label">Email</label>
                  <input
                    type="text"
                    class="form-control"
                    id="email"
                    name="email"
                    placeholder="Nhập email của bạn..."
                    autofocus
                  />
                </div>
                <div class="mb-3 form-password-toggle">
                  <div class="d-flex justify-content-between">
                    <label class="form-label" for="password">Mật khẩu</label>
                  </div>
                  <div class="input-group input-group-merge">
                    <input
                      type="password"
                      id="password"
                      class="form-control"
                      name="password"
                      placeholder="Nhập mật khảu của bạn..."
                      aria-describedby="password"
                    />
                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                  </div>
                </div>
                <div class="mb-3">
                  <button class="btn btn-primary d-grid w-100" type="submit">Đăng nhập</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- / Content -->
    <script src="{{URL('admin/ajax/login.js')}}"></script>
    <!-- Core JS -->
    <!-- build:js admin/assets/vendor/js/core.js -->
    <script src="{{URL('admin/assets/vendor/libs/jquery/jquery.js')}}"></script>
    <script src="{{URL('admin/assets/vendor/libs/popper/popper.js')}}"></script>
    <script src="{{URL('admin/assets/vendor/js/bootstrap.js')}}"></script>
    <script src="{{URL('admin/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js')}}"></script>

    <script src="{{URL('admin/assets/vendor/js/menu.js')}}"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->

    <!-- Main JS -->
    <script src="{{URL('admin/assets/js/main.js')}}"></script>

    <!-- Page JS -->

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
  </body>
</html>
