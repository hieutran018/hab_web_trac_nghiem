@extends('admin.layout')
@section('title','HAB Trắc Nghiệm - Admin | Quản lý thể loại bài viết' )
@section('content')
         <div class="pagetitle">
            <nav>
               <ol style="color:black; font-size:120%" class="breadcrumb">
                  <li class="breadcrumb-item">Trang chủ</li>
                  <li class="breadcrumb-item">Bài viết</li>
                  <li class="breadcrumb-item">Quản lý thể loại</li>
               </ol>
            </nav>
         </div>
         <section class="section dashboard">
            <div class="row">
                <div class="col-lg">
                    <div class="card" style="height: 220%">
                     <div class="card-body">
                        <h5 class="card-title">Danh sách thể loại bài viết</h5>
                        <div class="row">
                           <div class="col-3">
                              <button id="btn-create-news-category" type="button" style="width: 80%" class="btn btn-outline-primary">Thêm thể loại</button>
                           </div>
                        </div>
                        <br>
                        <table id="table-news-category" class="table">
                           <thead>
                              <tr>
                                 <th scope="col">ID</th>
                                 <th scope="col">Thể loại</th>
                                 <th scope="col">Ghi chú</th>
                                 <th scope="col">Thao tác</th>
                              </tr>
                           </thead>
                           <tbody id="tableNewsCategory">
                              
                           </tbody>
                        </table>
                     </div>
                  </div>
                </div>
            </div>
         </section>
         @include('admin.ajax.news_category')
         @include('admin.modal.create_news_category')
         @include('admin.modal.edit_news_category')
@stop