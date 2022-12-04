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
                        <div class="row">
                           <div class="col-3">
                              <button id="btn-create-account-admin" type="button" style="width: 80%" class="btn btn-outline-primary">Thêm tài khoản</button>
                           </div>
                        </div>
                        <table class="table table-hover dt-responsive" summary="This table shows how to create responsive tables using Datatables' extended functionality"
           >
                           <thead>
                              <tr>
                                 <th scope="col">ID</th>
                                 <th scope="col">Tên người dùng</th>
                                 <th scope="col">Email</th>
                                 <th scope="col">Số điện thoại</th>
                                 <th scope="col">Vị trí</th>
                                 <th scope="col">Trạng thái</th>
                                 <th scope="col">Thao tác</th>
                              </tr>
                           </thead>
                           <tbody>
                              
                           </tbody>
                        </table>
                        
                     </div>
                  </div>
                </div>
            </div>
         </section>
         @include('admin.modal.info_account_admin')
         @include('admin.modal.edit_account_admin')
         @include('admin.modal.create_account_admin')
         <script src="{{URL('admin/ajax/account_admin.js')}}"></script>
         
@stop