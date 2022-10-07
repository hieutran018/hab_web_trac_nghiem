$(document).ready(function () {
    fetchsAccountUser();

    function fetchsAccountUser() {

        $.ajax({
            type: "GET",
            url: "/admin/account-admin/list-account-user",
            dataType: "json",
            success: function (response) {
                // console.log(response.lst);
                $("#tableAccountAdmin").html("");
                $.each(response.lst, function (key, item) {
                    $("#tableAccountAdmin").append('<tr>\
                        <td>' + item.id + '</td>\
                        <td>' + item.first_name + '</td>\
                        <td>' + item.last_name + '</td>\
                        <td>' + item.email + '</td>\
                        <td>' + item.phone_number + '</td>\
                        <td>' + (item.status == 1 ? 'Hoạt động' : 'Bị khóa') + '</td>\
                        <td><button type="button" class="btn btn-info"><i style="color:white" class="bi bi-info-circle"></i></button>\
                        <button type = "button" class= "btn btn-danger" > <i class="bi bi-person-x"></i></button >\
                    <button type="button" class="btn btn-success"><i class="bi bi-pencil-square"></i></button></td >\
                        \</tr > ');
                });
            }
        });
    }


});