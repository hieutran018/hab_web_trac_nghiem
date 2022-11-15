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

    $(document).on('click', '#btn-create-level-question', function (e) {
        e.preventDefault();

        $('#createLevelQuestion').modal('show');
        var createAccountAdminForm = $('#create-level-question');
        createAccountAdminForm.submit(function (e) {
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
                        // $('#createAccountAdmin').find('input').val('');
                        $('#create-account-admin')[0].reset();
                    }
                    else if (data.status == 200) {
                        console.log(data);
                        // $('#createAccountAdmin').modal('hide');
                        // $('#createAccountAdmin').find('input').val('');

                        $('#create-level-question')[0].reset();
                        // $('#createAccountAdmin').modal('toggle');
                        // Swal.fire({
                        //     position: 'center',
                        //     icon: 'success',
                        //     title: 'Thêm tài khoản thành công!',
                        //     showConfirmButton: true,
                        //     confirmButtonText: 'Xác nhận',

                        // });
                        fetchLevelQuestion();

                    }

                },

            });
        });
    });


    //TODO : Chưa hoàn thành
    $(document).on('click', '#btn-edit-level', function (e) {
        e.preventDefault();
        var id_lv = $(this).val();
        $.ajax({
            type: 'GET',
            url: '/admin/games/level-questions/edit-level-questions/id=' + id_lv,
            dataType: 'json',
            success: function (data) {
                if (data.status == 200) {
                    $("#edit-topic-question-id").val(data.lv.id);
                    $("#edit-topic-question-name").val(data.lv.topic_question_name);
                    $("#edit-topic-description").val(data.lv.description);
                } else if (data.status == 404) {
                    alert('Không tìm thấy chủ đề câu hỏi');
                }
            }
        });
    });
});