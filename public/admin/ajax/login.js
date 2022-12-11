$(document).ready(function () {
    var loginForm = $("#formAuthentication");
    loginForm.submit(function (e) {
        e.preventDefault();
        var formData = loginForm.serialize();
        $.ajax({
            url: '/admin/login-post',
            type: 'POST',
            data: formData,
            beforeSend: function () {
                $(document).find('span.error-message-login').text("");
            },
            success: function (data) {
                if (data.status === 200) {
                    window.location.href = data.redirect_url;
                } else if (data.status === 400) {
                    console.log(data.message);
                    swal(data.message, {
                        icon: "error",
                    });
                } else if (data.status === 419) {
                    swal(data.message, {
                        icon: "error",
                    });
                } else if (data.status === 401) {
                    swal(data.message, {
                        icon: "error",
                    });
                }

            },

        });
    });
});
