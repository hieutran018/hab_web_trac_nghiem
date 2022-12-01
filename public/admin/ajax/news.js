$(document).ready(function () {
    fetchNews();

    //* Lấy danh sách bài viết
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
                        <td>' + (item.status == 1 ? 'Hiện' : 'Ẩn ') + '</td>\
                        <td>\
                        <button id="btn-detail-news" type="button" value="'+ item.id + '" class="btn btn-info"><i class="bi bi-info-circle"></i></button>\
                        <button id="btn-edit-news" type="button" value="'+ item.id + '" class="btn btn-success"><i class="bi bi-pencil-square"></i></button>\
                        <button id="btn-delete-news" type ="button" value="'+ item.id + '" class= "btn btn-danger" > <i class="bi bi-person-x"></i></button >\
                        </td>\
                        \</tr > ');
                });
            }
        });
    }

    //* Thêm bài viết
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

    //* Submit form Thêm bài viết
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
                    fetchNews();
                    swal({
                        position: 'center',
                        icon: 'success',
                        title: 'Thêm chủ đề bài viết thành công!',
                        showConfirmButton: true,
                        confirmButtonText: 'Xác nhận',

                    });
                    $('#create-news')[0].reset();
                    $('#createNews').modal('hide');
                }

            },

        });
    });

    //* Chi tiết bài viết
    $(document).on('click', '#btn-detail-news', function (e) {
        e.preventDefault();
        var news_id = $(this).val();
        $('#detailNews').modal('show');
        $.ajax({
            type: 'GET',
            url: '/admin/news/news-detail/id=' + news_id,
            dataType: 'json',
            success: function (data) {
                console.log(data.news.news_content);
                document.getElementById("detail-news-title").textContent = data.news.title;
                // $("#detail-news-content").html("");
                // $("#detail-news-content").append(data.news.news_content.replace(new RegExp('\r?\n', 'g'), '<br />'));
                document.getElementById("detail-news-content").textContent = data.news.news_content;
                document.getElementById('detail-news-image').src = data.news.image;
                document.getElementById('detail-news-user').textContent = data.news.user_id;
                document.getElementById('detail-news-category-id').textContent = data.news.news_category_id;
                document.getElementById('detail-news-created-at').textContent = data.news.created_at;
            }
        });
    });

    //* Cập nhật bài viết
    $(document).on('click', '#btn-edit-news', function (e) {
        e.preventDefault();
        var id_news = $(this).val();
        $('#editNews').modal('show');

        $.ajax({
            url: '/admin/news/news-categories/fetch-news-category',
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                if (data.status == 200) {
                    $("#edit-for-category").html("");
                    $.each(data.newsCategory, function (key, item) {
                        $("#edit-for-category").append('<option value=' + item.id + '> ' + item.news_category_name + '</option>')
                    });
                }
            }

        });
        $.ajax({
            type: 'GET',
            url: '/admin/news/news-edit/id=' + id_news,
            dataType: 'json',
            success: function (data) {
                document.getElementById("edit-title").value = data.news.title;
                document.getElementById("id-news").value = data.news.id;
                // $("#detail-news-content").html("");
                // $("#detail-news-content").append(data.news.news_content.replace(new RegExp('\r?\n', 'g'), '<br />'));
                document.getElementById("edit-news-content").value = data.news.news_content;
                document.getElementById('preview-image-edit-news').src = data.news.image;
                document.getElementById('edit-for-category').value = data.news.news_category_id;
                document.getElementById('edit-news-status').value = data.news.status;
            }
        });
    });

    //* Submit form cập nhật bài viết
    $('#edit-news').submit(function (e) {
        e.preventDefault();
        var formData = new FormData($('#edit-news')[0]);
        console.log('formData', formData);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: '/admin/news/update-news',
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
                        $('#error-edit-' + key).text(val[0]);
                    });
                }
                else if (data.status == 200) {
                    console.log(data);
                    fetchNews();
                    swal({
                        position: 'center',
                        icon: 'success',
                        title: 'Cập nhật bài viết thành công!',
                        showConfirmButton: true,
                        confirmButtonText: 'Xác nhận',

                    });
                    $('#edit-news')[0].reset();
                    $('#editNews').modal('hide');
                }

            },

        });
    });


    $(document).on('click', '#btn-delete-news', function (e) {
        e.preventDefault();
        var newsID = $(this).val();
        swal({
            title: "Hệ thống",
            text: "Bạn có chắc chắn muốn xóa bài viết này?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
            .then((willDelete) => {

                if (willDelete) {
                    console.log(willDelete);
                    $.ajax({
                        type: "GET",
                        url: "/admin/news/delete-news/id=" + newsID,
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
                                fetchNews();
                            }
                        }
                    });

                }
            });

    });
});