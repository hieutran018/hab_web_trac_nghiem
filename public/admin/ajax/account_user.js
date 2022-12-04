$(document).ready(function () {
    fetchsAccountUser();

    function fetchsAccountUser() {

        $.ajax({
            type: "GET",
            url: "/admin/account-admin/list-account-user",
            dataType: "json",
            success: function (response) {
                // console.log(response.lst);
                $("#tableAccountUser").html("");
                $.each(response.lst, function (key, item) {
                    $("#tableAccountUser").append('<tr>\
                        <td>' + item.id + '</td>\
                        <td>' + item.display_name + '</td>\
                        <td>' + item.email + '</td>\
                        <td>' + item.phone_number + '</td>\
                        <td>' + (item.status == 1 ? 'Hoạt động' : 'Bị khóa') + '</td>\
                        <td>\
                        <button id="btn-info-account-user" value = "'+ item.id + '" type="button" class="btn btn-info" > <i style="color:white" class="bi bi-info-circle"></i></button>\
                        <button id="btn-edit-account-user" value = "'+ item.id + '" type="button" class="btn btn-danger" > <i class="bi bi-person-x"></i></button>\
                        <button id="btn-delete-account-user" value = "'+ item.id + '" type="button" class="btn btn-success"><i class="bi bi-pencil-square"></i></button>\
                        </td>\
                        \</tr > ');
                });
                $('table').DataTable({
                    "pageLength": 10
                });
            }
        });
    }


    $(document).on('click', '#btn-info-account-user', function (e) {
        e.preventDefault();
        var id_account = $(this).val();
        $('#infoAccountUser').modal('show');
        $.ajax({
            type: 'GET',
            url: '/admin/account-admin/info-account-admin/id=' + id_account,
            success: function (response) {
                if (response.status == 200) {
                    document.getElementById("info-display-name-user").textContent = response.account.display_name;
                    document.getElementById("info-email-user").textContent = response.account.email;
                    document.getElementById("info-phoneNumber-user").textContent = response.account.phone_number;
                    document.getElementById("info-address-user").textContent = response.account.address;
                    document.getElementById("info-dateOfBirth-user").textContent = response.account.dateOfBirth;
                    if (response.account.isAdmin == 1 && response.account.isSubAdmin == 0) {
                        document.getElementById("info-position").textContent = 'Quản trị viên';
                    } else if (response.account.isAdmin == 0 && response.account.isSubAdmin == 1) {
                        document.getElementById("info-position").textContent = 'Cộng tác viên';
                    }
                    if (response.account.avatar == null) {
                        document.getElementById('info-avatar-user').src = 'http://127.0.0.1:8000/admin/assets/img/no_avatar.png';

                    } else {
                        document.getElementById('info-avatar-user').src = 'http://127.0.0.1:8000/storage/account/' + response.account.id + '/avatar/' + response.account.avatar;
                    }
                    // document.getElementById('edit-account-admin').value = response.account_admin.id;
                }
                else if (response.status == 400) {
                    console.log(response);
                    $("#infoAccountAdmin").modal("hide");
                    $('#infoAccountAdmin').on('shown.bs.modal', function () {
                        $('#infoAccountAdmin').modal('hide');

                    });
                    // $(".modal-backdrop").remove();
                    // $('body').removeClass('modal-open');
                    // $('body').css('padding-right', '');
                    // $("#infoAccountAdmin").hide();

                }
            }
        });
    });

});