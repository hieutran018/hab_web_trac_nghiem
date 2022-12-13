<script>
    $(document).ready(function () {

    var isFirstLoad = true;
    var dataTable = $('#table-question');

    fetchQuestion();

    //* Lấy danh sách câu hỏi
    function fetchQuestion() {
        $.ajax({
            type: "GET",
            url: '/admin/games/questions/fetch-question',
            dataType: "json",
            success: function (data) {
                if (data.status == 200) {
                    $("#tableQuestion").html("");
                    $.each(data.lstQuestion, function (key, item) {
                        $("#tableQuestion").append('<tr>\
                        <td>' + item.id + '</td>\
                        <td><div style="width:800px;white-space: nowrap; overflow: hidden;text-overflow: ellipsis;">' + item.question_content + '</div></td>\
                        <td>' + item.topic_id + '</td>\
                        <td>' + item.level_id + '</td>\
                        <td>\
                        <button id="btn-edit-question" type="button" value="'+ item.id + '" class="btn btn-success"><i class="bi bi-pencil-square"></i></button>\
                        <button id="btn-delete-question" type ="button" value="'+ item.id + '" class= "btn btn-danger" > <i class="bi bi-person-x"></i></button >\
                        </td >\
                        \</tr > ');
                    });
                }
                if(isFirstLoad) {
                    console.log(isFirstLoad);
                    dataTable.DataTable({
                        info: true,
                        retrieve: true,
                        "bDestroy": true,
                        "pageLength": 9,
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

    //* lấy danh sách level cho thẻ select
    function fetchLevel(tagSelect) {
        $.ajax({
            url: '/admin/games/level-questions/fetch-level-questions',
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                if (data.status == 200) {
                    $("#" + tagSelect + "-level-id").html("");
                    $.each(data.lv, function (key, item) {
                        $("#" + tagSelect + "-level-id").append('<option value=' + item.id + '> ' + item.level_name + '</option>')
                    });
                }
            }

        });
    }

    //* lấy danh sách topic cho thẻ select
    function fetchTopic(tagSelect) {
        $.ajax({
            url: '/admin/games/topic-questions/fetch-topic-questions',
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                if (data.status == 200) {
                    $("#" + tagSelect + "-topic-id").html("");
                    $.each(data.lstTopicQuestion, function (key, item) {
                        $("#" + tagSelect + "-topic-id").append('<option value=' + item.id + '> ' + item.topic_question_name + '</option>')
                    });
                }
            }

        });
    }


    //* Thêm câu hỏi
    $(document).on('click', '#btn-create-question', function (e) {
        e.preventDefault();
        $('#createQuestion').modal('show');
        var tag = 'add'

        fetchLevel(tag);
        fetchTopic(tag);

    });

    //* Submit form thêm câu hỏi
    $('#create-question').submit(function (e) {
        e.preventDefault();

        var formData = new FormData($('#create-question')[0]);

        console.log('formData', formData);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/admin/games/questions/create-question',
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
                else if (data.status === 200) {
                    $('#createQuestion').modal('hide');
                    $('#create-question')[0].reset();
                    swal({
                        position: 'center',
                        icon: 'success',
                        title: 'Thêm câu hỏi thành công!',
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



    //* Cập nhật câu hỏi
    $(document).on('click', '#btn-edit-question', function (e) {
        var id_question = $(this).val();
        $('#editQuestion').modal('show');
        var tag = 'edit';


        fetchTopic(tag);
        fetchLevel(tag);


        $.ajax({
            type: "GET",
            url: '/admin/games/questions/edit-question/id=' + id_question,
            dataType: "JSON",
            success: function (data) {
                console.log(data);
                document.getElementById("edit-question-id").value = data.question.id;
                document.getElementById("edit-question-content").value = data.question.question_content;
                document.getElementById("edit-topic-id").value = data.question.topic_id;
                document.getElementById("edit-level-id").value = data.question.level_id;
                for (var i = 1; i <= 4; i++) {
                    document.getElementById("edit-answer-content-" + i).value = data.answer[i - 1].answer_content;
                    document.getElementById("edit-answer-id-" + i).value = data.answer[i - 1].id;
                    if (data.answer[i - 1].isTrue == 1) {
                        document.getElementById("edit-gridRadios" + i).checked = true;
                    }
                }
            }
        });
    });

    //* Submit form cập nhật câu hỏi
    $('#edit-question').submit(function (e) {
        e.preventDefault();

        var formData = new FormData($('#edit-question')[0]);

        console.log('formData', formData);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/admin/games/questions/update-questions',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
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
                    $('#editQuestion').modal('hide');
                    swal({
                        position: 'center',
                        icon: 'success',
                        title: 'Cập nhật câu hỏi thành công!',
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
});
</script>