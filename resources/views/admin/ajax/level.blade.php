{{--* DONE *--}}
<script>
    $(document).ready(function () {

    var isFirstLoad = true;
    var dataTable = $('#table-level');

    fetchLevelQuestion();

    //* Lấy danh sách độ khó câu hỏi
    function fetchLevelQuestion() {
        $.ajax({
            type: "GET",
            url: "/admin/games/level-questions/fetch-level-questions",
            dataType: "json",
            success: function (response) {
                $("#tableLevelQuestion").html("");
                $.each(response.lv, function (key, item) {
                    $("#tableLevelQuestion").append('<tr>\
                        <td>' + item.id + '</td>\
                        <td>' + item.level_name + '</td>\
                        <td><div style="width:500px;white-space: nowrap; overflow: hidden;text-overflow: ellipsis;">' + item.description + '</div></td>\
                        <td>' + item.amount_question + '</td>\
                        <td>' + item.time_answer + '</td>\
                        <td>' + item.point + '</td>\
                        <td>\
                        <button id="btn-edit-level" type="button" value="'+ item.id + '" class="btn btn-success"><i class="bi bi-pencil-square"></i></button>\
                        <button id="btn-delete-level" type ="button" value="'+ item.id + '" class= "btn btn-danger" > <i class="bi bi-person-x"></i></button >\
                        </td>\
                        \</tr > ');
                });
                if (isFirstLoad) {
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

    //* Thêm độ khó câu hỏi
    $(document).on('click', '#btn-create-level-question', function (e) {
        e.preventDefault();
        $('#createLevelQuestion').modal('show');
    });

    //* Submit form Thêm độ khó câu hỏi
    $('#create-level-question').submit(function (e) {
        e.preventDefault();
        var formData = new FormData($('#create-level-question')[0]);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: '/admin/games/level-questions/create-level-questions',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: function () {
                $(document).find('span.error-message').text("");
            },
            success: function (data) {
                if (data.status === 400) {
                    $.each(data.message, function (key, val) {
                        $('#error-add-' + key).text(val[0]);
                    });
                }
                else if (data.status ===200) {
                    $('#createLevelQuestion').modal('hide');
                    swal({
                        position: 'center',
                        icon: 'success',
                        title: 'Thêm độ khó thành công!',
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


    //* Chi tiết độ khó câu hỏi
    $(document).on('click', '#btn-edit-level', function (e) {
        e.preventDefault();
        var id_lv = $(this).val();
        $('#editLevelQuestion').modal('show');
        $.ajax({
            type: 'GET',
            url: '/admin/games/level-questions/edit-level-questions/id=' + id_lv,
            dataType: 'json',
            success: function (data) {
                if (data.status === 200) {
                    $("#edit-level-question-id").val(data.lv.id);
                    $("#edit-level-question-name").val(data.lv.level_name);
                    $("#edit-level-description").val(data.lv.description);
                    $("#edit-level-amount").val(data.lv.amount_question);
                    $("#edit-level-time-answer").val(data.lv.time_answer);
                    $("#edit-level-point").val(data.lv.point);
                }
            }
        });
    });

    //* Cập nhật độ khó câu hỏi
        $('#edit-level-question').submit(function (e) {
            e.preventDefault();
            var formData = new FormData($('#edit-level-question')[0]);

            console.log('formData', formData);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '/admin/games/level-questions/update-level-questions',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                // dataType: 'json',
                beforeSend: function () {
                    $(document).find('span.error-message').text("");
                },
                success: function (data) {
                    if (data.status === 400) {
                        console.log(data.message);
                        $.each(data.message, function (key, val) {
                            $('#error-edit-' + key).text(val[0]);
                        });
                    }
                    else if (data.status === 200) {
                        fetchLevelQuestion();
                        $('#editLevelQuestion').modal('hide');
                        swal({
                            position: 'center',
                            icon: 'success',
                            title: 'Cập nhật thành công!',
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

    //* Xóa độ khó câu hỏi
    $(document).on('click', '#btn-delete-level', function (e) {
        e.preventDefault();
        var id_lv = $(this).val();
        swal({
            title: "Hệ thống",
            text: "Bạn có chắc chắn muốn xóa độ khó câu hỏi này?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        type: "GET",
                        url: "/admin/games/level-questions/delete-level-questions/id=" + id_lv,
                        dataType: "json",
                        success: function (data) {
                            if (data.status === 400) {
                                swal(data.message, {
                                    icon: "error",
                                });
                            }
                            else if (data.status === 200) {
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