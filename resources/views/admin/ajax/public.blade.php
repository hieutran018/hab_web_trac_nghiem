<script>
    $('#change-password').submit(function (e) {
        e.preventDefault();
        var formData = new FormData($('#change-password')[0]);
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
                    $('#change-password')[0].reset();
                    swal({
                        position: 'center',
                        icon: 'success',
                        title: data.message,
                        showConfirmButton: true,
                        confirmButtonText: 'Xác nhận',
                    }).then((confirm) => {
                        if (confirm) {
                            $('#changePassword').modal('hide');
                        }
                    });
                }
            },
        });
    });

</script>