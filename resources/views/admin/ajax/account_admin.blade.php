{{--* DONE *--}}
<script>
$(document).ready(function () {

    fetchsAccountAdmin();
    var isFirstLoad = true;
    var dataTable = $('#table-account-admin');

    //* Lấy danh sách tài khoản admin
    function fetchsAccountAdmin() { 
        $.ajax({
            type: "GET",
            url: "/admin/account-admin/list-account-admin",
            dataType: "json",
            success: function (response) {
                $("tbody").html("");
                $.each(response.lst, function (key, item) {
                    $("tbody").append('<tr>\
                        <td>' + item.id + '</td>\
                        <td>' + item.display_name + '</td>\
                        <td>' + item.email + '</td>\
                        <td>' + item.phone_number + '</td>\
                        <td>' + (item.isAdmin == 1 && item.isSubAdmin == 0 ? 'Quản trị viên' : item.isAdmin == 0 && item.isSubAdmin == 1 ? 'Cộng tác viên' : 'Chưa cấp quyền') + '</td>\
                        <td>' + (item.status == 1 ? 'Hoạt động' : 'Bị khóa') + '</td>\
                        <td>\
                        <button id ="btn-info-account-admin" value = "'+ item.id + '" type = "button" data - bs - toggle="modal" data - bs - target="#infoAccountAdmin" class= "btn btn-info" > <i style="color:white" class="bi bi-info-circle"></i></button >\
                        @if(Auth::user()->isAdmin == 1)\
                        <button id="btn-delete-account-admin" type ="button" value="'+ item.id + '" class= "btn btn-danger" > <i class="bi bi-person-x"></i></button >\
                        <button id="btn-edit-account-admin" type="button" value="'+ item.id + '" class="btn btn-success"><i class="bi bi-pencil-square"></i></button></td>\
                        @endif\
                        \</tr > ');
                });
                if (isFirstLoad) {
                    console.log(isFirstLoad);
                    dataTable.DataTable({
                        info: true,
                        retrieve: true,
                        "bDestroy": true,
                        "pageLength": 10,
                        "language": {
                            "sProcessing": "Đang tải dữ liệu...",
                            "sLengthMenu": "Hiển thị _MENU_ trong danh sách",
                            "sZeroRecords": "Không có kết quả nào được tìm thấy",
                            "sEmptyTable": "Không có dữ liệu trong bảng này",
                            "sInfo": "Hiện đang ở vị trí _START_ đến _END_ trong tổng số _TOTAL_ của danh sách",
                            "sInfoEmpty": "Hiển thị các bản ghi từ 0 đến 0 trong tổng số 0 bản ghi",
                            "sInfoFiltered": "(lọc từ tổng số _MAX_ trong danh sách)",
                            "sInfoPostFix": "",
                            "sSearch": "Tìm kiếm:",
                            "sUrl": "",
                            "sInfoThousands": ",",
                            "sLoadingRecords": "Đang sử lý...",
                            "oPaginate": {
                                "sFirst": "Trang đầu",
                                "sLast": "Trang cuối",
                                "sNext": "Tiến",
                                "sPrevious": "Lùi"
                            },
                            "oAria": {
                                "sSortAscending": ": Kích hoạt để sắp xếp cột theo thứ tự tăng dần",
                                "sSortDescending": ": Kích hoạt để sắp xếp cột theo thứ tự giảm dần"
                            }
                        }
                    });
                    isFirstLoad = false;
                }

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
                debugger
                if (data.status === 400) {
                    $.each(data.message, function (key, val) {
                        $('#error-add-' + key).text(val[0]);
                    });
                }else if(data.status === 417){
                        $('#error-add-error-password').text(data.error_password);
                }else if (data.status === 200) {
                    console.log(data);
                    $('#create-account-admin')[0].reset();
                    document.getElementById('create-account-admin-avatar').src = 'http://127.0.0.1:8000/admin/assets/img/no_avatar.png';
                    swal({
                        position: 'center',
                        icon: 'success',
                        title: 'Thêm tài khoản quản trị viên thành công!',
                        showConfirmButton: true,
                        confirmButtonText: 'Xác nhận',
                    }).then((confirm) => {
                        if (confirm) {
                            location.reload();
                        }
                    });

                }

            },

        });
    });

    //*Submit form Cập nhật thông tin tài khoản admin
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
                dataType: 'json',
                beforeSend: function () {
                    $(document).find('span.error-message').text("");
                },
                success: function (data) {
                    if (data.status == 400) {
                        $.each(data.message, function (key, val) {
                            $('#error-edit-' + key).text(val[0]);
                        });
                    } else if (data.status === 401) {
                        swal({
                            position: 'center',
                            icon: 'error',
                            title: data.message,
                            showConfirmButton: true,
                            confirmButtonText: 'Xác nhận',
                        });
                    }
                    else if (data.status === 403) {
                        swal({
                            position: 'center',
                            icon: 'error',
                            title: data.message,
                            showConfirmButton: true,
                            confirmButtonText: 'Xác nhận',

                        });
                    } else if (data.status === 200) {
                        $('#editAccountAdmin').modal('hide');
                        swal({
                            position: 'center',
                            icon: 'success',
                            title: 'Cập nhật thành công!',
                            showConfirmButton: true,
                            confirmButtonText: 'Xác nhận',
                        }).then((confirm) => {

                            if (confirm) {
                                // fetchsAccountAdmin();
                                location.reload();
                            }
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
        $.ajax({
            type: 'GET',
            url: '/admin/account-admin/edit-account-admin/id=' + id_account,
            success: function (response) {
                if (response.status === 200) {
                    $('#editAccountAdmin').modal('show');
                    document.getElementById("edit-id").value = response.account.id;
                    document.getElementById("btn-change-password-admin").value = response.account.id;
                    $("#edit-display-name").val(response.account.display_name);
                    document.getElementById("edit-email").textContent = response.account.email;
                    document.getElementById("edit-phoneNumber").value = response.account.phone_number;
                    document.getElementById("edit-address").value = response.account.address;
                    document.getElementById("edit-dateOfBirth").value = response.account.dateOfBirth;
                    document.getElementById("edit-status").value = response.account.status;
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
                } else if (response.status === 403) {
                    swal(response.message, {
                        icon: "error",
                    });
                }
            }
        });
    });

    //* Chi tiết tài khoản quản trị viên
    $(document).on('click', '#btn-info-account-admin', function (e) {
        e.preventDefault();
        var id_account = $(this).val();
        $('#infoAccountAdmin').modal('show');
        $.ajax({
            type: 'GET',
            url: '/admin/account-admin/info-account-admin/id=' + id_account,
            success: function (response) {
                if (response.status == 200) {
                    document.getElementById("info-display-name").textContent = response.account.display_name;
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
                }
                else if (response.status == 400) {
                    console.log(response);
                    swal(response.message, {
                        icon: "error",
                    });
                }
            }
        });
    });

    $(document).on('click', '#btn-delete-account-admin', function (e) {
        e.preventDefault();
        var id_acc = $(this).val();
        console.log(id_acc);
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
                                }).then((confirm) => {

                                    if (confirm) {
                                        // fetchsAccountAdmin();
                                        location.reload();
                                    }
                                });
                            }
                        }
                    });

                }
            });

    });

    $(document).on('click','#btn-change-password-admin',function(e){
        e.preventDefault();
        var userId = $(this).val();
        $('#changePassword').modal('show');
        document.getElementById('id-passowrd').value = userId;
    });

});
</script>






