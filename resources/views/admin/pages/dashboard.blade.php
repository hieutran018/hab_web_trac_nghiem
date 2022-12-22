@extends('admin.layout')
@section('title','HAB Trắc Nghiệm - Admin | Quản lý tài khoản quản trị viên' )
@section('content')
             <div class="pagetitle">
            <h1>Trang chủ</h1>
            
         </div>
         <section class="section dashboard">
            <div class="row">
<div class="card recent-sales overflow-auto">

                           <div class="card-body">
                              <h5 class="card-title">Bảng xếp hạng người chơi <span>| Thách đấu</span></h5>
                              <div >
                                <table id="table-rank" class="table table-borderless datatable dataTable-table">
                                 <thead>
                                    <tr>
                                        <th scope="col" data-sortable="" style="width: 10.9111%;"><a href="#">Thứ hạng</a></th>
                                        <th scope="col" data-sortable="" style="width: 9.89134%;"><a href="#">Ảnh đại diện</a></th>
                                        <th scope="col" data-sortable="" style="width: 15.0919%;"><a href="#">Tên người chơi</a></th>
                                        <th scope="col" data-sortable="" style="width: 15.0919%;"><a href="#">Điểm thách đấu</a></th>
                                        <th scope="col" data-sortable="" style="width: 15.0919%;"><a href="#">Điểm thử thách (chơi đơn)</a></th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                </tbody>
                              </table>
                            </div><div class="dataTable-bottom"><div class="dataTable-info">Showing 1 to 5 of 5 entries</div><nav class="dataTable-pagination"><ul class="dataTable-pagination-list"></ul></nav></div></div>
                           </div>
                        </div>
            </div>
         </section> 
         <script>
            $(document).ready(function(){
                var dataTable = $('#table-rank');
                fetchRank();
                function fetchRank() { 
                $.ajax({
                    type: "GET",
                    url: "/admin/dashboard/ranking",
                    dataType: "json",
                    success: function (response) {
                        var rank = 1;
                        console.log(response.lst);
                        $("tbody").html("");
                        $.each(response.lst, function (key, item) {
                            
                            $("tbody").append('<tr>\
                                <td>' + rank + '</td>\
                                <td><img width="50" src="'+item.user.avatar+'" alt="Profile" class="rounded-circle"></td>\
                                <td>' + item.user.display_name + '</td>\
                                <td>' + item.score_challenge + '</td>\
                                <td>' + item.score_single + '</td>\
                                \</tr > ');
                                rank = rank+1;
                        });
                        dataTable.DataTable({
                        info: true,
                        retrieve: true,
                        "bDestroy": true,
                        "pageLength": 8,
                        "bLengthChange": false,
                        "language": {
                            "sProcessing": "Đang tải dữ liệu...",
                            "sLengthMenu": "Hiển thị _MENU_ trong danh sách",
                            "sZeroRecords": "Không có kết quả nào được tìm thấy",
                            "sEmptyTable": "Không có dữ liệu trong bảng này",
                            "sInfo": "Hiện đang ở vị trí _START_ đến _END_ trong tổng số _TOTAL_ của danh sách",
                            "sInfoEmpty": "Hiển thị các bản ghi từ 0 đến 0 trong tổng số 0 bản ghi",
                            "sInfoFiltered": "(lọc từ tổng số _MAX_ trong danh sách)",
                            "sInfoPostFix": "",
                            "sSearch": "Tìm kiếm:",
                            "sUrl": "",
                            "sInfoThousands": ",",
                            "sLoadingRecords": "Đang sử lý...",
                            "oPaginate": {
                                "sFirst": "Trang đầu",
                                "sLast": "Trang cuối",
                                "sNext": "Tiến",
                                "sPrevious": "Lùi"
                            },
                            "oAria": {
                                "sSortAscending": ": Kích hoạt để sắp xếp cột theo thứ tự tăng dần",
                                "sSortDescending": ": Kích hoạt để sắp xếp cột theo thứ tự giảm dần"
                            }
                        }
                    });

                    }
                });
        }
            });
        </script>   
@stop