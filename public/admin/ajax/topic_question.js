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
                        <td>\
                        <button id="btn-edit-topic-question" type="button" value="'+ item.id + '" class="btn btn-success"><i class="bi bi-pencil-square"></i></button>\
                        <button id="btn-delete-topic-question" type ="button" value="'+ item.id + '" class= "btn btn-danger" > <i class="bi bi-person-x"></i></button >\
                        </td >\
                        \</tr > ');
                });
                $('table').DataTable({
                    "pageLength": 10
                });
            }
        });
    }


    //* Thêm chủ đề câu hỏi
    $(document).on('click', '#btn-create-topic-question', function (e) {
        e.preventDefault();
        $('#createTopicQuestion').modal('show');
    });

    //* Submit form thêm chủ đề câu hỏi
    $('#create-topic-question').submit(function (e) {
        e.preventDefault();
        console.log(2);
        var formData = new FormData($('#create-topic-question')[0]);
        // formData.append('image', $('#create-topic-image')[0].files[0]);
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

                    document.getElementById('preview-image-create-topic').src = 'http://127.0.0.1:8000/admin/assets/img/no_avatar.png';
                    $('#create-topic-question')[0].reset();
                }
                else if (data.status === 200) {
                    $('#create-topic-question')[0].reset();
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Thêm chủ đề câu hỏi thành công!',
                        showConfirmButton: true,
                        confirmButtonText: 'Xác nhận',

                    });
                    fetchTopicQuestion();
                    document.getElementById('preview-image-create-topic').src = 'http://127.0.0.1:8000/admin/assets/img/no_avatar.png';
                    $('#createTopicQuestion').modal('hide');
                }

            },

        });
    });


    //* Chi tiết chủ đề câu hỏi
    $(document).on('click', '#btn-edit-topic-question', function (e) {
        e.preventDefault();
        $('#editTopicQuestion').modal('show');
        var id_topic = $(this).val();
        // console.log(id_topic);
        $.ajax({
            type: 'GET',
            url: '/admin/games/topic-questions/edit-topic-questions/id=' + id_topic,
            dataType: 'json',
            success: function (data) {
                if (data.status == 200) {
                    $("#edit-topic-question-id").val(data.tpq.id);
                    $("#edit-topic-question-name").val(data.tpq.topic_question_name);
                    $("#edit-topic-description").val(data.tpq.description);

                    if (data.tpq.image == null) {
                        document.getElementById('preview-image-edit').src = 'http://127.0.0.1:8000/admin/assets/img/no_avatar.png';

                    } else {
                        document.getElementById('preview-image-edit').src = 'http://127.0.0.1:8000/storage/topic_question/' + data.tpq.image;
                    }
                } else if (data.status == 404) {
                    alert('Không tìm thấy chủ đề câu hỏi');
                }
            }
        });
    });

    //* Cập nhật chủ đề câu hỏi
    $('#edit-topic-question').submit(function (e) {
        e.preventDefault();
        // var formData = editAccountAdminForm.serialize();
        var formData = new FormData($('#edit-topic-question')[0]);
        formData.append('image', $('#edit-topic-image')[0].files[0]);
        console.log('formData', formData);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/admin/games/topic-questions/update-topic-questions',
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
                else if (data.status === 200) {
                    console.log(data);
                    document.getElementById("edit-topic-image").value = "";
                    fetchTopicQuestion();
                    $('#editTopicQuestion').modal('hide');
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Cập nhật thành công!',
                        showConfirmButton: true,
                        confirmButtonText: 'Xác nhận',

                    });

                }

            },

        });
    });

    //* Xóa chủ đề câu hỏi
    $(document).on('click', '#btn-delete-topic-question', function (e) {
        e.preventDefault();
        var id_tpq = $(this).val();
        swal({
            title: "Hệ thống",
            text: "Bạn có chắc chắn muốn xóa chủ đề câu hỏi này?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
            .then((willDelete) => {

                if (willDelete) {
                    console.log(willDelete);
                    $.ajax({
                        type: "GET",
                        url: "/admin/games/topic-questions/delete-topic-questions/id=" + id_tpq,
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
                                fetchTopicQuestion();
                            }
                        }
                    });

                }
            });
    });

});

