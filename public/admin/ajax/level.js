$(document).ready(function () {
    fetchLevelQuestion();

    //* Lấy danh sách độ khó câu hỏi
    function fetchLevelQuestion() {
        $.ajax({
            type: "GET",
            url: "/admin/games/level-questions/fetch-level-questions",
            dataType: "json",
            success: function (response) {
                // console.log(response.lst);
                $("#tableLevelQuestion").html("");
                $.each(response.lv, function (key, item) {
                    $("#tableLevelQuestion").append('<tr>\
                        <td>' + item.id + '</td>\
                        <td>' + item.level_name + '</td>\
                        <td>' + item.description + '</td>\
                        <td>' + item.amount_question + '</td>\
                        <td>' + item.time_answer + '</td>\
                        <td>' + item.point + '</td>\
                        <td>\
                        <button id="btn-edit-level" type="button" value="'+ item.id + '" class="btn btn-success"><i class="bi bi-pencil-square"></i></button>\
                        <button id="btn-delete-level" type ="button" value="'+ item.id + '" class= "btn btn-danger" > <i class="bi bi-person-x"></i></button >\
                        </td>\
                        \</tr > ');
                });
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
        // var formData = createAccountAdminForm.serialize();
        var formData = new FormData($('#create-level-question')[0]);

        console.log('formData', formData);
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
                    console.log(data.message);
                    $.each(data.message, function (key, val) {
                        $('#error-add-' + key).text(val[0]);
                    });
                    if (data.error_password != null) {
                        $('#error-add-error-password').text(data.error_password);
                    }
                    $('#create-account-admin')[0].reset();
                    $('#createLevelQuestion').modal('hide');
                }
                else if (data.status == 200) {
                    console.log(data);
                    // $('#createAccountAdmin').modal('hide');
                    // $('#createAccountAdmin').find('input').val('');

                    $('#create-level-question')[0].reset();
                    $('#createLevelQuestion').modal('hide');
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Thêm độ khó thành công!',
                        showConfirmButton: true,
                        confirmButtonText: 'Xác nhận',

                    })
                    fetchLevelQuestion();

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
                if (data.status == 200) {
                    $("#edit-level-question-id").val(data.lv.id);
                    $("#edit-level-question-name").val(data.lv.level_name);
                    $("#edit-level-description").val(data.lv.description);
                    $("#edit-level-amount").val(data.lv.amount_question);
                    $("#edit-level-time-answer").val(data.lv.time_answer);
                    $("#edit-level-point").val(data.lv.point);
                } else if (data.status == 404) {
                    alert('Không tìm thấy chủ đề câu hỏi');
                }
            }
        });
    });

    //* Cập nhật độ khó câu hỏi
    $(document).ready(function () {
        var editLevelQuestionForm = $('#edit-level-question');
        editLevelQuestionForm.submit(function (e) {
            e.preventDefault();
            // var formData = editAccountAdminForm.serialize();
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
                    if (data.status == 400) {
                        console.log(data.message);
                        $.each(data.message, function (key, val) {
                            $('#error-edit-' + key).text(val[0]);
                        });
                        if (data.error_password != null) {
                            $('#error-edit-error-password').text(data.error_password);
                        }

                    }
                    else if (data.status === 200) {
                        console.log(data);
                        fetchLevelQuestion();
                        $('#editLevelQuestion').modal('hide');
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Cập nhật thành công!',
                            showConfirmButton: true,
                            confirmButtonText: 'Xác nhận',

                        })

                    }

                },

            });
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
        })
            .then((willDelete) => {

                if (willDelete) {
                    console.log(willDelete);
                    $.ajax({
                        type: "GET",
                        url: "/admin/games/level-questions/delete-level-questions/id=" + id_lv,
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
                                });
                                fetchLevelQuestion();
                            }
                        }
                    });

                }
            });
    });
});