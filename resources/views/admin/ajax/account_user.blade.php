{{--TODO chưa có sự kiện Khóa/Mở Khóa tài khoản + Xóa User  --}}
<script>
    $(document).ready(function () {
    fetchsAccountUser();

    var isFirstLoad = true;
    var dataTable = $('#table-account-user');

    function fetchsAccountUser() {
        $.ajax({
            type: "GET",
            url: "/admin/account-admin/list-account-user",
            dataType: "json",
            success: function (response) {
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
                        @if(Auth::user()->isAdmin == 1)\
                        <button id="btn-delete-account-user" value = "'+ item.id + '" type="button" class="btn btn-danger" > <i class="bi bi-person-x"></i></button>\
                        <button id="btn-edit-account-user" value = "'+ item.id + '" type="button" class="btn btn-success"><i class="bi bi-pencil-square"></i></button>\
                        @endif\
                        </td>\
                        \</tr > ');
                });

                if (isFirstLoad) {
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

    //* Chi tiết thông tin user
    $(document).on('click', '#btn-info-account-user', function (e) {
        e.preventDefault();
        var id_account = $(this).val();
        $('#infoAccountUser').modal('show');
        $.ajax({
            type: 'GET',
            url: '/admin/account-user/info-account-user/id=' + id_account,
            success: function (response) {
                if (response.status == 200) {
                    document.getElementById("info-display-name-user").textContent = response.user.display_name;
                    document.getElementById("info-email-user").textContent = response.user.email;
                    document.getElementById("info-phoneNumber-user").textContent = response.user.phone_number;
                    document.getElementById("info-address-user").textContent = response.user.address;
                    document.getElementById("info-dateOfBirth-user").textContent = response.user.dateOfBirth;

                    if (response.user.avatar == null) {
                        document.getElementById('info-avatar-user').src = 'http://127.0.0.1:8000/admin/assets/img/no_avatar.png';

                    } else {
                        document.getElementById('info-avatar-user').src = 'http://127.0.0.1:8000/storage/account/' + response.user.id + '/avatar/' + response.user.avatar;
                    }
                    
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

    //* Cập nhật thông tin user
    $(document).on('click', '#btn-edit-account-user', function (e) {
        e.preventDefault();

        var id_account = $(this).val();
        $('#editAccountUser').modal('show');
        $.ajax({
            type: 'GET',
            url: '/admin/account-admin/edit-account-admin/id=' + id_account,
            success: function (response) {
                if (response.status == 200) {
                    console.log(response.account);
                    document.getElementById("edit-id-user").value = response.account.id;
                    document.getElementById("btn-change-password-user").value = response.account.id;
                    $("#edit-display-name-user").val(response.account.display_name);
                    document.getElementById("edit-email-user").value = response.account.email;
                    document.getElementById("edit-phoneNumber-user").value = response.account.phone_number;
                    document.getElementById("edit-address-user").value = response.account.address;
                    document.getElementById("edit-dateOfBirth-user").value = response.account.dateOfBirth;
                    document.getElementById("edit-status").value = response.account.status;

                    if (response.account.avatar == null) {
                        document.getElementById('edit-avatar-user').src = 'http://127.0.0.1:8000/admin/assets/img/no_avatar.png';
                    } else {
                        document.getElementById('edit-avatar-user').src = 'http://127.0.0.1:8000/storage/account/' + response.account.id + '/avatar/' + response.account.avatar;
                    }
                }
            }
        });
    });

    //* Submit form cập nhật thông tin user
    $(document).ready(function () {
        var editAccountAdminForm = $('#edit-account-user');
        editAccountAdminForm.submit(function (e) {
            e.preventDefault();
            var formData = new FormData($('#edit-account-user')[0]);
            formData.append('avatar', $('#edit-upload')[0].files[0]);
            console.log('formData', formData);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '/admin/account/account-user/update',
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
                        fetchsAccountUser();

                        $('#editAccountUser').modal('hide');
                        swal({
                            position: 'center',
                            icon: 'success',
                            title: 'Cập nhật thành công!',
                            showConfirmButton: true,
                            confirmButtonText: 'Xác nhận',

                        }).then((confirm) => {

                            if (confirm) {
                                // fetchsAccountUser();
                                location.reload();
                            }
                        });

                    }

                },

            });
        });
    });

    $(document).on('click', '#btn-delete-account-user', function (e) {
        e.preventDefault();
        var user_id = $(this).val();
        console.log(user_id);
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
                        url: "/admin/account-admin/delete-account-user/id=" + user_id,
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


    $(document).on('click','#btn-change-password-user',function(e){
        e.preventDefault();
        var userId = $(this).val();
        $('#changePassword').modal('show');
        document.getElementById('id-passowrd').value = userId;
    });
});
</script>