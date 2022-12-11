@extends('admin.layout')
@section('title','HAB Trắc Nghiệm - Admin | Quản lý độ khó câu hỏi' )
@section('content')
             <div class="pagetitle">
            <nav>
               <ol style="color:black; font-size:120%;" class="breadcrumb">
                  <li class="breadcrumb-item">Trang chủ</li>
                  <li class="breadcrumb-item">Quản lý trò chơi</li>
                  <li class="breadcrumb-item">Quản lý câu hỏi</li>
               </ol>
            </nav>
         </div>
         <section class="section dashboard">

            <div class="row">
                <div class="col-lg">
                    <div class="card" style="height: 220%">
                     <div class="card-body">
                        <h5 class="card-title">Danh sách câu hỏi</h5>
                        <div class="row">
                           <div class="col-3">
                              <button id="btn-create-question" type="button" style="width: 80%" class="btn btn-outline-primary">Thêm câu hỏi</button>
                           </div>
                        </div>
                        <br>
                        <table id="table-question" class="table">
                           <thead>
                              <tr>
                                 <th scope="col">ID</th>
                                 <th scope="col">Nội dung câu hỏi</th>
                                 <th scope="col">Chủ đề câu hỏi</th>
                                 <th scope="col">Độ khó</th>
                                 <th scope="col">Thao tác</th>
                              </tr>
                           </thead>
                           <tbody id="tableQuestion">
                              
                           </tbody>
                        </table>
                     </div>
                  </div>
                </div>
            </div>
         </section>
         @include('admin.ajax.question')
         @include('admin.modal.create_question')
         @include('admin.modal.edit_question')
@stop