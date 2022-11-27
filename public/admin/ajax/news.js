$(document).ready(function () {
    fetchNews();
    function fetchNews() {
        $.ajax({
            type: "GET",
            url: "/admin/news/fetch-news",
            dataType: "json",
            success: function (response) {
                // console.log(response.lst);
                $("#tableNews").html("");
                $.each(response.lstNews, function (key, item) {
                    $("#tableNews").append('<tr>\
                        <td>' + item.id + '</td>\
                        <td>' + item.title + '</td>\
                        <td>' + item.news_category_id + '</td>\
                        <td>' + item.user_id + '</td>\
                        <td>' + (item.status == 1 ? 'Hoạt động' : 'Bị khóa') + '</td>\
                        <td>\
                        <button id="btn-edit-level" type="button" value="'+ item.id + '" class="btn btn-success"><i class="bi bi-pencil-square"></i></button>\
                        <button id="btn-delete-level" type ="button" value="'+ item.id + '" class= "btn btn-danger" > <i class="bi bi-person-x"></i></button >\
                        </td>\
                        \</tr > ');
                });
            }
        });
    }

    $(document).on('click', '#btn-create-news', function (e) {
        e.preventDefault();
        $('#createNews').modal('show');
        $.ajax({
            url: '/admin/news/news-categories/fetch-news-category',
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                if (data.status == 200) {
                    $("#create-for-category").html("");
                    $.each(data.newsCategory, function (key, item) {
                        $("#create-for-category").append('<option value=' + item.id + '> ' + item.news_category_name + '</option>')
                    });
                }
            }

        });
    });

    $('#create-news').submit(function (e) {
        e.preventDefault();
        var formData = new FormData($('#create-news')[0]);
        console.log('formData', formData);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: '/admin/news/create-news',
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
                    console.log(data);
                    fetchNewsCategory();
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Thêm chủ đề bài viết thành công!',
                        showConfirmButton: true,
                        confirmButtonText: 'Xác nhận',

                    });
                    $('#create-news-category')[0].reset();
                    $('#createNewsCategory').modal('hide');
                }

            },

        });
    });
});