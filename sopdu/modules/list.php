<?php
require_once ($_SERVER["DOCUMENT_ROOT"].'/sopdu/class/module/list.php');
$returnRes = '';
if(!empty($_POST["listAdd"])) {
    if (ilsList::seeItem('list', ilsMain::translit($_POST["listAdd"]["name"])) == 'N') {
        ilsList::add('list', $_POST["listAdd"]);
        $ok = 'Список успешно создан';
    } else {
        $error = 'Такой список уже существует';
    }
}
if(!empty($_POST["itemListAdd"])){
    if (ilsList::seeItem('list_item', ilsMain::translit($_POST["listAdd"]["name"])) == 'N') {
        ilsList::add('list_item', $_POST["itemListAdd"]);
        $ok = 'Элемент списка добавлен';
        $returnRes = $_POST["itemListAdd"]["listID"];
    } else {
		$error = 'Такой элемент списка уже есть';
    }
}
if(!empty($_GET["delete"])){
	ilsList::drop('list_item', $_GET["delete"]);
	$returnRes = $_GET["list"];
}
if(!empty($_GET["deleteLise"])){
    ilsList::dropItems('list_item', 'list_id', $_GET["deleteLise"]);
    ilsList::drop('list', $_GET["deleteLise"]);
    echo '<meta http-equiv="refresh" content="0;url='.$_SERVER["HTTP_ORIGIN"].$_SERVER["PHP_SELF"].'">';
}
if(!empty($_POST["updateItem"])){
    ilsList::updateItem($_POST["updateItem"]);
    $ok = 'Элемент списка изменен';
    $returnRes = $_POST["updateItem"]["listId"];
    echo '<meta http-equiv="refresh" content="0;url='.$_SERVER["HTTP_ORIGIN"].$_SERVER["PHP_SELF"].'?list='.$_POST["updateItem"]["listId"].'">';
}
if(!empty($_POST["updateList"])){
    ilsList::updateList($_POST["updateList"]);
    echo '<meta http-equiv="refresh" content="0;url='.$_SERVER["HTTP_ORIGIN"].$_SERVER["PHP_SELF"].'">';
}
?>