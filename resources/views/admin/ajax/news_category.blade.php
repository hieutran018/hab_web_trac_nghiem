{{--* DONE *--}}
<script>
    $(document).ready(function(){
         
    var isFirstLoad = true;
    var dataTable = $('#table-news-category');

    fetchNewsCategory();

    //* Lấy danh sách thể loại bài viết
    function fetchNewsCategory() {
        $.ajax({
            type: "GET",
            url: "/admin/news/news-categories/fetch-news-category",
            dataType: "json",
            success: function (response) {
                $("#tableNewsCategory").html("");
                $.each(response.newsCategory, function (key, item) {
                    $("#tableNewsCategory").append('<tr>\
                        <td>' + item.id + '</td>\
                        <td>' + item.news_category_name + '</td>\
                        <td>' + item.description + '</td>\
                        <td>\
                        <button id="btn-delete-news-category" type ="button" value="'+ item.id + '" class= "btn btn-danger" > <i class="bi bi-person-x"></i></button >\
                        <button id="btn-edit-news-category" type="button" value="'+ item.id + '" class="btn btn-success"><i class="bi bi-pencil-square"></i></button></td >\
                        \</tr > ');
                });

                if(isFirstLoad) {
                    console.log(isFirstLoad);
                    dataTable.DataTable({
                        info: true,
                        retrieve: true,
                        "bDestroy": true,
                        "pageLength": 10,
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
                    isFirstLoad = false;
                }
            }
        });
    }

    //* Thêm thể loại bài viết
    $(document).on('click', '#btn-create-news-category', function (e) {
        e.preventDefault();
        $("#createNewsCategory").modal('show');
    });

     //* Submit form Thêm thể loại bài viết
    $('#create-news-category').submit(function (e) {
        e.preventDefault();
        var formData = new FormData($('#create-news-category')[0]);
        console.log('formData', formData);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: '/admin/news/news-categories/create-news-category',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: function () {
                $(document).find('span.error-message').text("");
            },
            success: function (data) {
                if (data.status == 400) {
                    console.log(data.message);
                    $.each(data.message, function (key, val) {
                        $('#error-add-' + key).text(val[0]);
                    });

                }
                else if (data.status == 200) {
                    $("#createNewsCategory").modal('hide');
                    swal({
                        position: 'center',
                        icon: 'success',
                        title: 'Thêm chủ đề bài viết thành công!',
                        showConfirmButton: true,
                        confirmButtonText: 'Xác nhận',

                    }).then((confirm) => {
                        if (confirm) {
                            location.reload();
                        }
                    });
                }

            },

        });
    });
    
    //* Cập nhật thể loại bài viết
    $(document).on('click', '#btn-edit-news-category', function (e) {
        e.preventDefault();
        var newsCategoryID = $(this).val();
        $('#editNewsCategory').modal('show');
        $.ajax({
            type: 'GET',
            url: '/admin/news/news-categories/edit-news-category/id=' + newsCategoryID,
            success: function (response) {
                if (response.status == 200) {
                    console.log(response.newsCategory);
                    $("#edit-news-category-id").val(response.newsCategory.id);
                    $("#edit-category-name").val(response.newsCategory.news_category_name);
                    $("#edit-description").val(response.newsCategory.description);
                }
            }
        });

    });

    $('#edit-news-category').submit(function (e) {
        e.preventDefault();
        var formData = new FormData($('#edit-news-category')[0]);
        console.log('formData', formData);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/admin/news/news-categories/update-news-category',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            // dataType: 'json',
            beforeSend: function () {
                $(document).find('span.error-message').text("");
            },
            success: function (data) {
                if (data.status == 400) {
                    console.log(data.message);
                    $.each(data.message, function (key, val) {
                        $('#error-edit-' + key).text(val[0]);
                    });
                }
                else if (data.status == 200) {
                    $('#editNewsCategory').modal('hide');
                    swal({
                        position: 'center',
                        icon: 'success',
                        title: 'Cập nhật chủ đề bài viết thành công!',
                        showConfirmButton: true,
                        confirmButtonText: 'Xác nhận',

                    }).then((confirm) => {
                        if (confirm) {
                            location.reload();
                        }
                    });
                }
            },

        });
    });

    //* Xóa chủ đề bài viết
    $(document).on('click', '#btn-delete-news-category', function (e) {
        e.preventDefault();
        var id_ncg = $(this).val();
        swal({
            title: "Hệ thống",
            text: "Bạn có chắc chắn muốn xóa chủ đề bài viết này?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
            .then((willDelete) => {

                if (willDelete) {
                    console.log(willDelete);
                    $.ajax({
                        type: "GET",
                        url: "/admin/news/news-categories/delete-news-category/id=" + id_ncg,
                        dataType: "json",
                        success: function (data) {
                            if (data.status == 400) {
                                swal(data.message, {
                                    icon: "error",
                                });
                            }
                            else if (data.status == 200) {
                                swal(data.message, {
                                    icon: "success",
                                }).then((confirm) => {
                                    if (confirm) {
                                        location.reload();
                                    }
                                });
                            }
                        }
                    });
                }
            });
    });

    });
</script>