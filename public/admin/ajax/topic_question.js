$(document).ready(function () {
    fetchTopicQuestion();

    //* Lấy danh sách chủ đề câu hỏi
    function fetchTopicQuestion() {
        $.ajax({
            type: "GET",
            url: "/admin/games/topic-questions/fetch-topic-questions",
            dataType: "json",
            success: function (response) {
                console.log(response.lstTopicQuestion);
                $("#tableTopicQuestion").html("");
                $.each(response.lstTopicQuestion, function (key, item) {
                    $("#tableTopicQuestion").append('<tr>\
                        <td>' + item.id + '</td>\
                        <td>' + item.topic_question_name + '</td>\
                        <td>' + item.description + '</td>\
                        <td>' + (item.status == 1 ? 'Hiện' : 'Ẩn') + '</td>\
                        <td><button id="btn-detail-topic-question" value="'+ item.id + '" type="button" data-bs-toggle="modal" data-bs-target="#infoAccountAdmin" class="btn btn-info"><i style="color:white" class="bi bi-info-circle"></i></button>\
                        <button id="btn-delete-topic-question" type ="button" value="'+ item.id + '" class= "btn btn-danger" > <i class="bi bi-person-x"></i></button >\
                        <button id="btn-edit-topic-question" type="button" value="'+ item.id + '" class="btn btn-success"><i class="bi bi-pencil-square"></i></button></td >\
                        \</tr > ');
                });
            }
        });
    }


    //* Thêm chủ đề câu hỏi

});

$(document).on('click', '#btn-create-topic-question', function (e) {
    e.preventDefault();

    $('#createTopicQuestion').modal('show');
    var createAccountAdminForm = $('#create-topic-question');
    createAccountAdminForm.submit(function (e) {
        e.preventDefault();
        // var formData = createAccountAdminForm.serialize();
        var formData = new FormData($('#create-topic-question')[0]);
        formData.append('image', $('#create-topic-image')[0].files[0]);
        console.log('formData', formData);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: '/admin/games/topic-questions/create-topic-questions',
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
                else if (data.status === 200) {
                    console.log(data);
                    // $('#createAccountAdmin').modal('hide');
                    // $('#createAccountAdmin').find('input').val('');

                    $('#create-account-admin')[0].reset();
                    // $('#createAccountAdmin').modal('toggle');
                    // Swal.fire({
                    //     position: 'center',
                    //     icon: 'success',
                    //     title: 'Thêm tài khoản thành công!',
                    //     showConfirmButton: true,
                    //     confirmButtonText: 'Xác nhận',

                    // });
                    fetchsAccountAdmin();

                }

            },

        });
    });


});