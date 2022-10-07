
$(document).ready(function () {
    var createAccountAdminForm = $('#formCreateAccount');
    createAccountAdminForm.submit(function (e) {
        e.preventDefault();
        // var formData = createAccountAdminForm.serialize();
        var formData = new FormData($('#formCreateAccount')[0]);
        // formData.append('imgs', $('#upload')[0].files[0]);
        console.log('formData', formData);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: '/admin/account-admin/create-account-admin',
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
                    if (data.error_password != null) {
                        $('#error-add-error-password').text(data.error_password);
                    }

                }
                else if (data.status == 200) {
                    console.log(data);
                    $('#addAdmin').modal('hide');
                    $('#formCreateAccount')[0].reset();
                }

            },

        });
    });
});

$(document).ready(function () {
    fetchsAccountAdmin();
    function fetchsAccountAdmin() {

        $.ajax({
            type: "GET",
            url: "/admin/account-admin/list-account-admin",
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
                        <td>' + (item.isAdmin == 1 && item.isSubAdmin == 0 ? 'Quản trị viên' : item.isAdmin == 0 && item.isSubAdmin == 1 ? 'Cộng tác viên' : 'Chưa cấp quyền') + '</td>\
                        <td>' + (item.status == 1 ? 'Hoạt động' : 'Bị khóa') + '</td>\
                        <td><button id="btn-info-account-admin" value="'+ item.id + '" type="button" data-bs-toggle="modal" data-bs-target="#infoAccountAdmin" class="btn btn-info"><i style="color:white" class="bi bi-info-circle"></i></button>\
                        <button id="btn-delete-account-admin" type ="button" value="'+ item.id + '" class= "btn btn-danger" > <i class="bi bi-person-x"></i></button >\
                    <button id="btn-edit-account-admin" type="button" value="'+ item.id + '" class="btn btn-success"><i class="bi bi-pencil-square"></i></button></td >\
                        \</tr > ');
                });
            }
        });
    }
});

$(document).on('click', '#btn-info-account-admin', function (e) {
    e.preventDefault();
    var id_account = $(this).val();
    // console.log(id_account);
    $.ajax({
        type: 'GET',
        url: '/admin/account-admin/info-account-admin/id=' + id_account,
        success: function (response) {
            if (response.status == 200) {
                console.log(response.account);
                // document.getElementById("id_account").textContent = response.account_admin.id;
                document.getElementById("info-fName").value = response.account.first_name;
                document.getElementById("info-lName").value = response.account.last_name;
                document.getElementById("info-email").value = response.account.email;
                document.getElementById("info-phoneNumber").value = response.account.phone_number;
                document.getElementById("info-address").value = response.account.address;
                document.getElementById("info-dateOfBirth").value = response.account.dateOfBirth;
                if (response.account.isAdmin == 1 && response.account.isSubAdmin == 0) {
                    document.getElementById("info-position").value = 1;
                } else if (response.account.isAdmin == 0 && response.account.isSubAdmin == 1) {
                    document.getElementById("info-position").value = 2;
                }
                if (response.account.avatar == null) {
                    $(".info-avatar").src = 'http://127.0.0.1:8000/admin/assets/img/no_avatar.png';

                } else {
                    $(".info-avatar").src = 'http://127.0.0.1:8000/admin/assets/img/no_avatar.png';
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
                alert(response.message);
            }
        }
    });
});