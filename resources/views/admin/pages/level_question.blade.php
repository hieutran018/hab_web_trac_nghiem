@extends('admin.layout')
@section('title','HAB Trắc Nghiệm - Admin | Quản lý độ khó câu hỏi' )
@section('content')
             <div class="pagetitle">
            <nav>
               <ol style="color:black; font-size:120%;" class="breadcrumb">
                  <li class="breadcrumb-item">Trang chủ</li>
                  <li class="breadcrumb-item">Quản lý trò chơi</li>
                  <li class="breadcrumb-item">Quản lý độ khó câu hỏi</li>
               </ol>
            </nav>
         </div>
         <section class="section dashboard">

            <div class="row">
                <div class="col-lg">
                    <div class="card" style="height: 220%">
                     <div class="card-body">
                        <h5 class="card-title">Danh sách độ khó câu hỏi</h5>
                        <div class="row">
                           <div class="col-3">
                              <button id="btn-create-level-question" type="button" style="width: 80%" class="btn btn-outline-primary">Thêm độ khó</button>
                           </div>
                        </div>
                        <br>
                        <table class="table" id="table-level">
                           <thead>
                              <tr>
                                 <th scope="col">ID</th>
                                 <th scope="col">Tên độ khó</th>
                                 <th scope="col">Ghi chú</th>
                                 <th scope="col">Số lượng câu hỏi</th>
                                 <th scope="col">Thời gian trả lời</th>
                                 <th scope="col">Điểm mỗi câu</th>
                                 <th scope="col">Thao tác</th>
                              </tr>
                           </thead>
                           <tbody id="tableLevelQuestion">
                              
                           </tbody>
                        </table>
                     </div>
                  </div>
                </div>
            </div>
         </section>
         @include('admin.ajax.level')
         @include('admin.modal.create_level_question')
         @include('admin.modal.edit_level_question')
@stop