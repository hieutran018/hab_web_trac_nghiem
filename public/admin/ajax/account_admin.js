$(document).ready(function () {
    var createAccountAdminForm = $('#formCreateAccount');
    createAccountAdminForm.submit(function (e) {
        e.preventDefault();
        var formData = createAccountAdminForm.serialize();
        console.log('formData', formData);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: '/admin/account/create-account-admin',
            type: 'POST',
            data: formData,

            success: function (data) {
                console.log('susccess', data);

            },
            error: function (data) {

                console.log('fail', data);
            }
        });
    });
});