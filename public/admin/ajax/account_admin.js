
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