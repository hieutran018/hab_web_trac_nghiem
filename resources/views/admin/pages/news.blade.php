@extends('admin.layout')
@section('title','HAB Trắc Nghiệm - Admin | Quản lý bài viết' )
@section('content')
         <div class="pagetitle">
            <nav>
               <ol style="color:black; font-size:120%" class="breadcrumb">
                  <li class="breadcrumb-item">Trang chủ</li>
                  <li class="breadcrumb-item">Bài viết</li>
                  <li class="breadcrumb-item">Quản lý bài viết</li>
               </ol>
            </nav>
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
                        <h5 class="card-title">Danh sách bài viết</h5>
                        <div class="row">
                           <div class="col-3">
                              <button id="btn-create-news" type="button" style="width: 80%" class="btn btn-outline-primary">Thêm bài viết</button>
                           </div>
                        </div>
                        <table class="table">
                           <thead>
                              <tr>
                                 <th scope="col">ID</th>
                                 <th scope="col">Tiều đề</th>
                                 <th scope="col">Chủ đề</th>
                                 <th scope="col">Người viết</th>
                                 <th scope="col">Trạng thái</th>
                                 <th scope="col">Thao tác</th>
                              </tr>
                           </thead>
                           <tbody id="tableNews">
                              
                           </tbody>
                        </table>
                     </div>
                  </div>
                </div>
            </div>
         </section>
         <script src="{{URL('admin/ajax/news.js')}}"></script>
         @include('admin.modal.create_news')
         @include('admin.modal.edit_news_category')
@stop