<?php require_once ($_SERVER["DOCUMENT_ROOT"].'/sopdu/modules/login.php');?>
<?/*
<div id="controls">
    <div align=right><a class="close" title="Закрыть" onclick="document.getElementById('controls').style.display='none';">X</a></div>
</div>
*/?>
<?#='<pre>'; print_r(ilsLogin::seeSid()); '</pre>';?>
<?if(ilsLogin::seeSid() == 'N'):?>
    <body class="login-page">
    <main>
        <div class="login-block">
            <img src="../sopdu/template/img/logoNii.png" alt="Scanfcode">
            <h1>Введите свои данные</h1>
            <form method="post">
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user ti-user"></i></span>
                        <input type="text" class="form-control" name="login[name]" placeholder="Ваш логин">
                    </div>
                </div>

                <hr class="hr-xs">

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-lock ti-unlock"></i></span>
                        <input type="password" class="form-control" name="login[pass]" placeholder="Ваш пароль">
                    </div>
                </div>

                <button class="btn btn-primary btn-block" type="submit">ВОЙТИ В СИСТЕМУ</button>
                <?/*
                <div class="login-footer">
                    <h6>или войдите с помощью</h6>
                    <ul class="social-icons">
                        <li><a class="facebook" href="#"><i class="fa fa-facebook"></i></a></li>
                        <li><a class="twitter" href="#"><i class="fa fa-twitter"></i></a></li>
                        <li><a class="linkedin" href="#"><i class="fa fa-linkedin"></i></a></li>
                    </ul>
                </div>
                */?>
            </form>
        </div>
        <div class="login-links">
            <p class="text-center">Еще нету аккаунта? <a class="txt-brand" href="#user-login.html"><font color=#29aafe>Регистрация</font></a></p>
        </div>
    </main>
 <?
 die();
 endif;
 ?>
