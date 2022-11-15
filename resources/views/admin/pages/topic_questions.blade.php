@extends('admin.layout')
@section('title','HAB Trắc Nghiệm - Admin | Quản lý chủ đề câu hỏi' )
@section('content')
             <div class="pagetitle">
            <nav>
               <ol style="color:black; font-size:120%;" class="breadcrumb">
                  <li class="breadcrumb-item">Trang chủ</li>
                  <li class="breadcrumb-item">Quản lý trò chơi</li>
                  <li class="breadcrumb-item">Quản lý chủ đề câu hỏi</li>
               </ol>
            </nav>
         </div>
         <section class="section dashboard">

            <div class="row">
                <div class="col-lg">
                    <div class="card" style="height: 220%">
                     <div class="card-body">
                        <h5 class="card-title">Danh sách chủ đề câu hỏi</h5>
                        <div class="row">
                           <div class="col-3">
                              <button id="btn-create-topic-question" type="button" style="width: 80%" class="btn btn-outline-primary">Thêm chủ đề</button>
                           </div>
                        </div>
                        <table class="table">
                           <thead>
                              <tr>
                                 <th scope="col">ID</th>
                                 <th scope="col">Họ</th>
                                 <th scope="col">Tên</th>
                                 
                                 
                                 <th scope="col">Trạng thái</th>
                                 <th scope="col">Thao tác</th>
                              </tr>
                           </thead>
                           <tbody id="tableTopicQuestion">
                              
                           </tbody>
                        </table>
                     </div>
                  </div>
                </div>
            </div>
         </section>
         @include('admin.modal.create_topic_question')
         @include('admin.modal.edit_topic_question')
         <script src="{{URL('admin/ajax/topic_question.js')}}"></script>
@stop