@extends('admin.layout')
@section('title','HAB Trắc Nghiệm - Admin | Quản lý tài khoản quản trị viên' )
@section('content')
             <div class="pagetitle">
            <h1>Trang chủ</h1>
            
         </div>
         <section class="section dashboard">
            <div class="row">
                  <div class="col-lg">
                    <div class="card" style="height: 220%">
                     <div class="card-body">
                        <h5 class="card-title">Danh sách tài khoản Quản trị viên</h5>
                        @if(Auth::user()->isAdmin == 1)
                        <div class="row">
                           <div class="col-3">
                              <button id="btn-create-account-admin" type="button" style="width: 80%" class="btn btn-outline-primary">Thêm tài khoản</button>
                           </div>
                        </div>
                        <br>
                        @endif
                        <table id="table-account-admin" class="table table-hover dt-responsive" summary="This table shows how to create responsive tables using Datatables' extended functionality">
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
         
         @include('admin.ajax.account_admin')
         @include('admin.modal.info_account_admin')
         @include('admin.modal.edit_account_admin')
         @include('admin.modal.create_account_admin')
         @include('admin.modal.change_password_account')
         @include('admin.ajax.public')
         
         
@stop