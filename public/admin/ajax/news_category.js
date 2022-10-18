$(document).ready(function () {
    fetchNewsCategory();

    //*---------------Lấy danh sách thể loại bài viết--------------------//
    function fetchNewsCategory() {

        $.ajax({
            type: "GET",
            url: "/admin/news/news-categories/fetch-news-category",
            dataType: "json",
            success: function (response) {
                console.log(response.newsCategory);
                $("#tableNewsCategory").html("");
                $.each(response.newsCategory, function (key, item) {
                    $("#tableNewsCategory").append('<tr>\
                        <td>' + item.id + '</td>\
                        <td>' + item.news_category_name + '</td>\
                        <td>' + item.description + '</td>\
                        <td>' + (item.status == 1 ? 'Hiện' : 'Ẩn') + '</td>\
                        <td><button id="btn-edit-status-news-category" value="'+ item.id + '" type="button" data-bs-toggle="modal" data-bs-target="#infoAccountAdmin" class="btn btn-info"><i style="color:white" class="bi bi-info-circle"></i></button>\
                        <button id="btn-delete-news-category" type ="button" value="'+ item.id + '" class= "btn btn-danger" > <i class="bi bi-person-x"></i></button >\
                        <button id="btn-edit-news-category" type="button" value="'+ item.id + '" class="btn btn-success"><i class="bi bi-pencil-square"></i></button></td >\
                        \</tr > ');
                });
            }
        });
    }
    //*------------------------------------------------------------------//

    //*------------------Thêm thể loại bài viết--------------------------//
    $(document).on('click', '#btn-create-news-category', function (e) {
        e.preventDefault();
        $("#createNewsCategory").modal('show');
        var createNewsCategoryForm = $('#create-news-category');
        createNewsCategoryForm.submit(function (e) {
            e.preventDefault();
            var formData = new FormData($('#create-news-category')[0]);
            // formData.append('imgs', $('#upload')[0].files[0]);
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
                        console.log(data);
                        fetchNewsCategory();
                        $('#createNewsCategory').modal('hide');
                    }

                },

            });
        });

    });
    //*------------------------------------------------------------------//

    //*---------------Cập nhật thể loại bài viết-------------------------//
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

    $(document).ready(function () {
        var editNewsCategoryForm = $('#edit-news-category');
        editNewsCategoryForm.submit(function (e) {
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
                            $('#error-add-' + key).text(val[0]);
                        });
                        if (data.error_password != null) {
                            $('#error-add-error-password').text(data.error_password);
                        }

                    }
                    else if (data.status == 200) {
                        console.log(data);
                        fetchNewsCategory();
                        $('#editNewsCategory').modal('hide');


                    }

                },

            });
        });
    });
    //*------------------------------------------------------------------//


});