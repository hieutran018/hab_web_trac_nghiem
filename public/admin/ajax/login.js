$(document).ready(function () {
    var loginForm = $("#formAuthentication");
    loginForm.submit(function (e) {
        e.preventDefault();
        var formData = loginForm.serialize();

        $.ajax({
            url: '/admin/login-post',
            type: 'POST',
            data: formData,
            success: function (data) {
                window.location.href = data.redirect_url;
                console.log(formData);
                console.log(data);
            },
            error: function (data) {
                console.log(formData);
                console.log(data);
            }
        });
    });
});
