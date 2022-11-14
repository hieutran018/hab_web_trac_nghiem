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
    $(document).on('click', '#btn-create-topic-question', function (e) {
        e.preventDefault();
        $('#createTopicQuestion').modal('show');
        var creaeTopicQuestion = $('create-topic-question');
        creaeTopicQuestion.submit(function () {
            e.preventDefault();
            var formData = new FormData($('create-topic-question')[0]);
            formData.append('image', $('#create-topic-image')[0].files[0]);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: '/admin/account-admin/update-account-admin',
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
                        fetchTopicQuestion();
                        $('#editAccountAdmin').modal('hide');
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
});