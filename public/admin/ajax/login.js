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
                if (data.status == 200) {
                    window.location.href = data.redirect_url;
                    console.log(formData);
                    console.log(data);
                } else if (data.status == 400) {
                    console.log(formData);
                    console.log(data.message);
                    $.each(data.message, function (key, val) {
                        $('#error-' + key + '-login').text(val[0]);
                    });
                }

            },

        });
    });
});
