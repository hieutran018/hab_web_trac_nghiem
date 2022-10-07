@extends('admin.layout')
@section('title','HAB Trắc Nghiệm - Admin | Quản lý tài khoản quản trị viên' )
@section('content')
             <div class="pagetitle">
            <h1>Trang chủ</h1>
            
         </div>
         <section class="section dashboard">
            <div class="row">
               <div class="col-lg">
                  <div class="row">
                     <div class="col-xxl-4 col-md-6">
                        <div class="card info-card sales-card">
                           <div class="filter">
                              <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                              <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                 <li class="dropdown-header text-start">
                                    <h6>Filter</h6>
                                 </li>
                                 <li><a class="dropdown-item" href="#">Today</a></li>
                                 <li><a class="dropdown-item" href="#">This Month</a></li>
                                 <li><a class="dropdown-item" href="#">This Year</a></li>
                              </ul>
                           </div>
                           <div class="card-body">
                              <h5 class="card-title">Sales <span>| Today</span></h5>
                              <div class="d-flex align-items-center">
                                 <div class="card-icon rounded-circle d-flex align-items-center justify-content-center"> <i class="bi bi-cart"></i></div>
                                 <div class="ps-3">
                                    <h6>145</h6>
                                    <span class="text-success small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">increase</span>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-xxl-4 col-md-6">
                        <div class="card info-card revenue-card">
                           <div class="filter">
                              <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                              <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                 <li class="dropdown-header text-start">
                                    <h6>Filter</h6>
                                 </li>
                                 <li><a class="dropdown-item" href="#">Today</a></li>
                                 <li><a class="dropdown-item" href="#">This Month</a></li>
                                 <li><a class="dropdown-item" href="#">This Year</a></li>
                              </ul>
                           </div>
                           <div class="card-body">
                              <h5 class="card-title">Revenue <span>| This Month</span></h5>
                              <div class="d-flex align-items-center">
                                 <div class="card-icon rounded-circle d-flex align-items-center justify-content-center"> <i class="bi bi-currency-dollar"></i></div>
                                 <div class="ps-3">
                                    <h6>$3,264</h6>
                                    <span class="text-success small pt-1 fw-bold">8%</span> <span class="text-muted small pt-2 ps-1">increase</span>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-xxl-4 col-xl-12">
                        <div class="card info-card customers-card">
                           <div class="filter">
                              <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                              <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                 <li class="dropdown-header text-start">
                                    <h6>Filter</h6>
                                 </li>
                                 <li><a class="dropdown-item" href="#">Today</a></li>
                                 <li><a class="dropdown-item" href="#">This Month</a></li>
                                 <li><a class="dropdown-item" href="#">This Year</a></li>
                              </ul>
                           </div>
                           <div class="card-body">
                              <h5 class="card-title">Customers <span>| This Year</span></h5>
                              <div class="d-flex align-items-center">
                                 <div class="card-icon rounded-circle d-flex align-items-center justify-content-center"> <i class="bi bi-people"></i></div>
                                 <div class="ps-3">
                                    <h6>1244</h6>
                                    <span class="text-danger small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">decrease</span>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="row">
                <div class="col-lg">
                    <div class="card" style="height: 220%">
                     <div class="card-body">
                        <h5 class="card-title">Danh sách tài khoản Quản trị viên</h5>
                        <table class="table">
                           <thead>
                              <tr>
                                 <th scope="col">ID</th>
                                 <th scope="col">Họ</th>
                                 <th scope="col">Tên</th>
                                 <th scope="col">Email</th>
                                 <th scope="col">Số điện thoại</th>
                                 <th scope="col">Vị trí</th>
                                 <th scope="col">Trạng thái</th>
                                 <th scope="col">Thao tác</th>
                              </tr>
                           </thead>
                           <tbody id="tableAccountAdmin">
                              
                           </tbody>
                        </table>
                     </div>
                  </div>
                </div>
            </div>
         </section>
            @include('admin.modal.info_account_admin')
         <script src="{{URL('admin/ajax/account_admin.js')}}"></script>
         $(document).on('click', '#btn-info-account-admin', function (e) {
    e.preventDefault();
    $('#infoAccountAdmin').modal('show');
    var id_account = $(this).val();
    // console.log(id_account);
    $.ajax({
        type: 'GET',
        url: '/admin/account-admin/info-account-admin/id=' + id_account,
        success: function (response) {
            if (response.status == 200) {
                console.log(response.account);
                // document.getElementById("id_account").textContent = response.account_admin.id;
                document.getElementById("info-fName").value = response.account.first_name;
                document.getElementById("info-lName").value = response.account.last_name;
                document.getElementById("info-email").value = response.account.email;
                document.getElementById("info-phoneNumber").value = response.account.phone_number;
                document.getElementById("info-address").value = response.account.address;
                document.getElementById("info-dateOfBirth").value = response.account.dateOfBirth;
                if (response.account.isAdmin == 1 && response.account.isSubAdmin == 0) {
                    document.getElementById("info-position").value = 1;
                } else if (response.account.isAdmin == 0 && response.account.isSubAdmin == 1) {
                    document.getElementById("info-position").value = 2;
                }
                if (response.account.avatar == null) {
                    $(".info-avatar").src = 'http://127.0.0.1:8000/admin/assets/img/no_avatar.png';

                } else {
                    $(".info-avatar").src = 'http://127.0.0.1:8000/admin/assets/img/no_avatar.png';
                }
                // document.getElementById('edit-account-admin').value = response.account_admin.id;
            }
            else if (response.status == 400) {
                console.log(response);
                $('#infoAccountAdmin').modal('hide');
            }
        }
    });
});
@stop