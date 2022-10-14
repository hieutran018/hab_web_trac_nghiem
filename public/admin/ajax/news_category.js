$(document).ready(function () {
    fetchNewsCategory();

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
                        <td><button id="btn-info-account-admin" value="'+ item.id + '" type="button" data-bs-toggle="modal" data-bs-target="#infoAccountAdmin" class="btn btn-info"><i style="color:white" class="bi bi-info-circle"></i></button>\
                        <button id="btn-delete-account-admin" type ="button" value="'+ item.id + '" class= "btn btn-danger" > <i class="bi bi-person-x"></i></button >\
                        <button id="btn-edit-account-admin" type="button" value="'+ item.id + '" class="btn btn-success"><i class="bi bi-pencil-square"></i></button></td >\
                        \</tr > ');
                });
            }
        });
    }



});