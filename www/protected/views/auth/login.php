<div class="row-fluid login" id="page_login">
    <div class="dialog">
        <div class="block">
            <div class="block-header">
                <h2>Вход в систему</h2>
            </div>
            <form action="/auth/login" method="post">
                <label for="login">Логин</label>
                <input id="login" type="text" class="span12">
                <!--<a class="reset-password" href="reset-password.html">Забыли пароль?</a>-->
                <label for="password">Пароль</label>
                <input id="password" type="password" class="span12">
                <div class="form-actions">
                    <i class="login-loader" style="display: none"></i>
                    <span class="login-error" style="display: none"></span>
                    <input type="submit" class="btn btn-success pull-right" value="Вход">
                    <!--<label class="remember-me"><input type="checkbox"> Remember me</label>-->
                    <!--<a href="sign-up.html" class="sign-up">Sign Up</a>-->
                    <div class="clearfix"></div>
                </div>
            </form>
        </div>
    </div>
</div>