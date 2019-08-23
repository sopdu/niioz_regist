<?#require_once ('/sopdu/class/module/')?>
<nav class="navbar navbar-default  navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">
                НИИОЗММ ДЗМ
            </a>

        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li <?if($_SERVER["SCRIPT_NAME"] == '/adm/list.php'):?>class="active"<?endif;?>><a href="/adm/list.php">Списки</a></li>
                <li <?if($_SERVER["SCRIPT_NAME"] == '/adm/form.php'):?>class="active"<?endif;?>><a href="/adm/form.php">Формы</a></li>
                <li <?if($_SERVER["SCRIPT_NAME"] == '/adm/users.php'):?>class="active"<?endif;?>><a href="/adm/users.php">Организации и пользователи</a></li>
                <li <?if($_SERVER["SCRIPT_NAME"] == ''):?>class="active"<?endif;?>><a href="#">ЦУП</a></li>
                <li <?if($_SERVER["SCRIPT_NAME"] == ''):?>class="active"<?endif;?>><a href="#">Result</a></li>
                <li style="background: red;"><a style="color: white" href="?action=exit">Выход</a></li>
            </ul>

        </div>

    </div>
</nav>