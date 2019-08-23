<?php
require_once ($_SERVER["DOCUMENT_ROOT"].'/sopdu/class/module/users.php');
$returnRes = '';
if(!empty($_POST["organizationAdd"])){
	if(empty(ilsUsers::organizationGetByCode(ilsMain::translit($_POST["organizationAdd"]["name"])))){
		if($_POST["organizationAdd"]["adm"] == 'on'){
			$adm = 'Y';
		} else {
			$adm = 'N';
		}
		if($_POST["organizationAdd"]["formAll"] == 'on'){
			$formAll = 'Y';
		} else {
			$formAll = 'N';
		}
		if($_POST["organizationAdd"]["formEdit"] == 'on'){
			$formEdit = 'Y';
		} else {
			$formEdit = 'N';
		}
		ilsUsers::organizationAdd($_POST["organizationAdd"]["name"], $adm, $formAll, $formEdit);
		$ok = 'Организация <strong>'.$_POST["organizationAdd"]["name"].'</strong> успешно создана';
	} else {
		$error = 'Оганизация <strong>'.$_POST["organizationAdd"]["name"].'</strong> уже есть';
	}
}
if(!empty($_POST["userAdd"])){
    if($_POST["userAdd"]["pass"] !== $_POST["userAdd"]["passReplay"]){
        $error = 'Пароль и подтверждания пароля не совпадают';
    } elseif (empty($_POST["userAdd"]["email"])) {
        $error = 'Не указана почта';
    } elseif(!empty(ilsUsers::userGetLogin($_POST["userAdd"]["login"]))) {
        $error = 'Логин "'.$_POST["userAdd"]["login"].'" уже используеться.';
    } else {
        ilsUsers::userAdd(
            $_POST["userAdd"]["login"],
            $_POST["userAdd"]["pass"],
            $_POST["userAdd"]["organization"],
            $_POST["userAdd"]["email"],
            $_POST["userAdd"]["phone"],
            $_POST["userAdd"]["name"],
            $_POST["userAdd"]["surname"],
            $_POST["userAdd"]["patronymic"]
        );
        $ok = 'Пользователь благополучно добавлен';
    }
}
if(!empty($_GET["deleteUser"])){
    ilsUsers::userDrop($_GET["deleteUser"]);
    $ok = 'Пользователь безвозвратно удален';
}
if(!empty($_GET["updateUser"])){

}
?>