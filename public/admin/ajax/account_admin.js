$(document).ready(function () {

    fetchsAccountAdmin();

    //* Lấy danh sách tài khoản admin
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


    //Thêm tài khoản quản trị viên
    $(document).on('click', '#btn-create-account-admin', function (e) {
        e.preventDefault();

        $('#createAccountAdmin').modal('show');
    });
    //* Submit form thêm tài khoản quản trị viên
    $('#create-account-admin').submit(function (e) {
        e.preventDefault();
        var formData = new FormData($('#create-account-admin')[0]);
        console.log(1);
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
                    $('#create-account-admin')[0].reset();
                    document.getElementById('create-avatar').src = 'http://127.0.0.1:8000/admin/assets/img/no_avatar.png';
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Thêm tài khoản quản trị viên thành công!',
                        showConfirmButton: true,
                        confirmButtonText: 'Xác nhận',

                    });
                    $('#createAccountAdmin').modal('hide');
                    fetchsAccountAdmin();

                }

            },

        });
    });

    //* Cập nhật thông tin tài khoản admin
    $(document).ready(function () {
        var editAccountAdminForm = $('#edit-account-admin');
        editAccountAdminForm.submit(function (e) {
            e.preventDefault();
            var formData = new FormData($('#edit-account-admin')[0]);
            formData.append('avatar', $('#edit-upload')[0].files[0]);
            console.log('formData', formData);
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
                        fetchsAccountAdmin();
                        $('#editAccountAdmin').modal('hide');
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
    });

    //* Cập nhật tài khoản quản trị viên
    $(document).on('click', '#btn-edit-account-admin', function (e) {
        e.preventDefault();

        var id_account = $(this).val();
        console.log('ID EDIT ACCOUNT', id_account);
        $.ajax({
            type: 'GET',
            url: '/admin/checkisAdmin',
            success: function (response) {
                if (response.status != 400) {
                    $('#editAccountAdmin').modal('show');
                    $.ajax({
                        type: 'GET',
                        url: '/admin/account-admin/edit-account-admin/id=' + id_account,
                        success: function (response) {
                            if (response.status == 200) {
                                console.log(response.account);
                                document.getElementById("edit-id").value = response.account.id;
                                $("#edit-fName").val(response.account.first_name);
                                document.getElementById("edit-lName").value = response.account.last_name;
                                document.getElementById("edit-email").value = response.account.email;
                                document.getElementById("edit-phoneNumber").value = response.account.phone_number;
                                document.getElementById("edit-address").value = response.account.address;
                                document.getElementById("edit-dateOfBirth").value = response.account.dateOfBirth;
                                if (response.account.isAdmin == 1 && response.account.isSubAdmin == 0) {
                                    document.getElementById("info-position").value = 1;
                                } else if (response.account.isAdmin == 0 && response.account.isSubAdmin == 1) {
                                    document.getElementById("edit-position").value = 1;
                                }
                                if (response.account.avatar == null) {
                                    document.getElementById('edit-avatar').src = 'http://127.0.0.1:8000/admin/assets/img/no_avatar.png';

                                } else {
                                    document.getElementById('edit-avatar').src = 'http://127.0.0.1:8000/storage/account/' + response.account.id + '/avatar/' + response.account.avatar;
                                }
                                // document.getElementById('edit-account-admin').value = response.account_admin.id;
                            }
                        }
                    });
                }
                else {
                    alert(response.message);

                }
            }
        });
    });

    //* Chi tiết tài khoản quản trị viên
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
                    document.getElementById("info-fName").textContent = response.account.first_name;
                    document.getElementById("info-lName").textContent = response.account.last_name;
                    document.getElementById("info-email").textContent = response.account.email;
                    document.getElementById("info-phoneNumber").textContent = response.account.phone_number;
                    document.getElementById("info-address").textContent = response.account.address;
                    document.getElementById("info-dateOfBirth").textContent = response.account.dateOfBirth;
                    if (response.account.isAdmin == 1 && response.account.isSubAdmin == 0) {
                        document.getElementById("info-position").textContent = 'Quản trị viên';
                    } else if (response.account.isAdmin == 0 && response.account.isSubAdmin == 1) {
                        document.getElementById("info-position").textContent = 'Cộng tác viên';
                    }
                    if (response.account.avatar == null) {
                        document.getElementById('info-avatar').src = 'http://127.0.0.1:8000/admin/assets/img/no_avatar.png';

                    } else {
                        document.getElementById('info-avatar').src = 'http://127.0.0.1:8000/storage/account/' + response.account.id + '/avatar/' + response.account.avatar;
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

    $(document).on('click', '#btn-delete-account-admin', function (e) {
        e.preventDefault();
        var id_acc = $(this).val();

        swal({
            title: "Hệ thống",
            text: "Bạn có chắc chắn muốn xóa tài khoản này?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
            .then((willDelete) => {

                if (willDelete) {
                    console.log(willDelete);
                    $.ajax({
                        type: "GET",
                        url: "/admin/account-admin/delete-account-admin/id=" + id_acc,
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
                                fetchsAccountAdmin();
                            }
                        }
                    });

                }
            });

    });
});







