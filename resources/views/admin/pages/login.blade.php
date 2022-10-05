<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta content="width=device-width, initial-scale=1.0" name="viewport">
      <title>Pages / Login - Admin Bootstrap Template</title>
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
   <body style="background-color: rgb(171, 253, 253)">
      <main>
         <div class="container">
            <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
               <div class="container">
                  <div class="row justify-content-center">

                     <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
                      <div class="d-flex justify-content-center py-4"><img src="{{URL('admin/assets/img/ic_logo_hab.png')}}" alt="" sizes="20"></div>
                        <div class="d-flex justify-content-center py-4"> <a href="index.html" class="logo d-flex align-items-center w-auto"> <span class="d-none d-lg-block">Đăng nhập trang Quản trị</span> </a></div>
                        <div class="card mb-3">
                           <div class="card-body">
                              <div class="pt-4 pb-2">
                                 <p style="text-align: center">Đăng nhập bằng email và mật khẩu được cấp.</p>
                                 
                              </div>
                              <form class="row g-3 needs-validation" novalidate>
                                 <div class="col-12">
                                    <label for="yourUsername" class="form-label">Email</label>
                                    <div class="input-group has-validation">
                                       <input type="text" name="email" class="form-control" id="login-email" required>
                                       <div class="invalid-feedback">Please enter your username.</div>
                                    </div>
                                 </div>
                                 <div class="col-12">
                                    <label for="yourPassword" class="form-label">Mật khẩu</label> <input type="password" name="password" class="form-control" id="yourPassword" required>
                                    <div class="invalid-feedback">Please enter your password!</div>
                                 </div>
                                 
                                 <div class="col-12"> <button class="btn btn-primary w-100" type="submit">Đăng nhập</button></div>
                                 
                              </form>
                           </div>
                        </div>
                        
                     </div>
                  </div>
               </div>
            </section>
         </div>
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