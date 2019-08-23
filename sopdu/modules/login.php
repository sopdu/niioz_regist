<?php
require_once ($_SERVER["DOCUMENT_ROOT"].'/sopdu/class/module/login.php');
if(!empty(ilsLogin::See($_POST["login"]["name"], $_POST["login"]["pass"]))){
    ilsLogin::addSid(ilsLogin::See($_POST["login"]["name"], $_POST["login"]["pass"])["id"]);
}
if($_GET["action"] === 'exit'){
    ilsLogin::dropSid();
    echo '<meta http-equiv="refresh" content="0; url=http://'.$_SERVER["HTTP_HOST"].'/">';
}
?>