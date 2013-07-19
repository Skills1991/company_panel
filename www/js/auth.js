$(function () {
    $('form').submit(function () {

        var $error = $('.login-error');
        $error.hide().text('');

        var login = $('#login').val();
        var password = $('#password').val();

        if (login.length === 0) {
            $error.show().text('Введите логин');
            return false;
        }

        if (password.length === 0) {
            $error.show().text('Введите пароль');
            return false;
        }

        var $btn = $('input[type=submit]');
        $btn.prop('disabled', true);

        var $loader = $('.login-loader');
        $loader.show();

        $.ajax({
            url: '/auth/login',
            method: 'post',
            data: {
                login: login,
                password: password,
            },
            complete: function () {
                $loader.hide();
                $btn.prop('disabled', false);
            },
            success: function (response) {
                response = jQuery.parseJSON(response);

                if (response.success) {
                    document.location = response.url;
                }
                else {
                    $error.show().text(response.error);
                }
            },
            error: function () {
                $error.show().text('Ошибка сервера');
            }
        });

        return false;
    });
});