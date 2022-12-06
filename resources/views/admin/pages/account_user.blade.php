@extends('admin.layout')
@section('title','HAB Trắc Nghiệm - Admin | Quản lý tài khoản người dùng' )
@section('content')
             <div class="pagetitle">
            <h1>Trang chủ</h1>
            
         </div>
         <section class="section dashboard">

            <div class="row">
                <div class="col-lg">
                    <div class="card" style="height: 220%">
                     <div class="card-body">
                        <h5 class="card-title">Danh sách tài khoản người dùng</h5>
                        <table id="table-account-user" class="table table-hover dt-responsive">
                           <thead>
                              <tr>
                                 <th scope="col">ID</th>
                                 <th scope="col">Tên người dùng</th>
                                 <th scope="col">Email</th>
                                 <th scope="col">Số điện thoại</th>
                                 <th scope="col">Trạng thái</th>
                                 <th scope="col">Thao tác</th>
                              </tr>
                           </thead>
                           <tbody id="tableAccountUser">
                              
                           </tbody>
                        </table>
                     </div>
                  </div>
                </div>
            </div>
            @include('admin.ajax.account_user')
            @include('admin.modal.info_account_user')
            @include('admin.modal.edit_account_user')
            @include('admin.modal.change_password_user')
         
@stop