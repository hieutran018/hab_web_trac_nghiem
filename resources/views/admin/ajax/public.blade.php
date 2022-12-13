<script>
    $('#form-change-password').submit(function (e) {
        e.preventDefault();
        var formData = new FormData($('#form-change-password')[0]);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: '/admin/account/account-user/change-password',
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
                        $('#error-change-' + key).text(val[0]);
                    });
                }
                else if(data.status === 409){
                    $('#error-password-not-match').text(data.message);
                } else if (data.status === 200) {
                    $('#form-change-password')[0].reset();
                    swal({
                        position: 'center',
                        icon: 'success',
                        title: data.message,
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


    $(document).on('click','#btn-change-password-account-current',function(e){
        e.preventDefault();
        $('#changePasswordAccountCurrent').modal('show');
    });

    $('#form-change-password-account-current').submit(function (e) {
        e.preventDefault();
        var formData = new FormData($('#form-change-password-account-current')[0]);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: '/admin/change-password-account-current',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: function () {
                $(document).find('span.error-message').text("");
            },
            success: function (data) {
                if(data.status === 400){
                   $.each(data.message, function (key, val) {
                        $('#error-change-password-current-' + key).text(val[0]);
                    });
                } else if(data.status === 401){
                    swal(data.message, {
                        icon: "error",
                    });
                } else if (data.status === 200) {
                    $('#form-change-password')[0].reset();
                    swal({
                        position: 'center',
                        icon: 'success',
                        title: data.message,
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

    $(document).on('click','#btn-edit-account-current',function(e){
        e.preventDefault();
        $('#editAccountCurrent').modal('show');
        $.ajax({
            type: "GET",
            url:"/admin/info-account-current",
            dataType: "JSON",
            success: function(data){
                if(data.status === 200){
                    document.getElementById("current-id").textContent = data.user.id;
                    document.getElementById("current-display-name").value = data.user.display_name;
                    document.getElementById("current-email").value = data.user.email;
                    document.getElementById("current-phoneNumber").value = data.user.phone_number;
                    document.getElementById("current-address").value = data.user.address;
                    document.getElementById("current-dateOfBirth").value = data.user.dateOfBirth;
                    
                    if (data.user.avatar == null) {
                        document.getElementById('current-avatar').src = 'http://127.0.0.1:8000/admin/assets/img/no_avatar.png';
                    } else {
                        document.getElementById('current-avatar').src = 'http://127.0.0.1:8000/storage/account/' + data.user.id + '/avatar/' + data.user.avatar;
                    }
                }
            }
        })
    });

    $('#current-account-admin').submit(function (e) {
        e.preventDefault();
        var formData = new FormData($('#current-account-admin')[0]);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: '/admin/update-account-current',
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
                    swal(data.message, {
                        icon: "error",
                    });
                }
                else if (data.status === 200) {
                    $('#form-change-password')[0].reset();
                    swal({
                        position: 'center',
                        icon: 'success',
                        title: data.message,
                        showConfirmButton: true,
                        confirmButtonText: 'Xác nhận',
                    }).then((confirm) => {
                        if (confirm) {
                            if (confirm) {
                            location.reload();
                        }
                        }
                    });
                }
            },
        });
    });


</script>