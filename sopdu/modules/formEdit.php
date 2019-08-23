<?php
require_once ($_SERVER["DOCUMENT_ROOT"].'/sopdu/class/module/formEdit.php');
$returnRes = '';
ilsMain::dump($_POST);
/*
 Array
(
    [updateFields] => Array
        (
            [name] => вфыв
            [code] => вфыв
            [type] => number
            [required] => on
            [sort] => 104
        )

)

 * */
if(!empty($_GET["deleteForm"])){
    ilsEditForm::drop('form', $_GET["deleteForm"]);
    echo '<meta http-equiv="refresh" content="0;url='.$_SERVER["HTTP_ORIGIN"].$_SERVER["PHP_SELF"].'">';
}
if(!empty($_GET["deleteField"])){
    ilsEditForm::drop('form_field', $_GET["deleteField"]);
    if(!empty($_GET["form"])){
        echo '<meta http-equiv="refresh" content="0;url='.$_SERVER["HTTP_ORIGIN"].$_SERVER["PHP_SELF"].'?form='.$_GET["form"].'">';
    }
}
if(!empty($_POST["updateForm"])){
    ilsEditForm::updateForm($_POST["updateForm"]);
    echo '<meta http-equiv="refresh" content="0;url='.$_SERVER["HTTP_ORIGIN"].$_SERVER["PHP_SELF"].'">';
}
if(!empty($_POST["formAdd"])){
    if(ilsEditForm::see('form', ilsMain::translit($_POST["formAdd"]["name"])) == 'N'){
        ilsEditForm::add('form', $_POST["formAdd"]);
        $ok = 'Форма успешно создана';
    } else {
        $error = 'Такая форма уже существует';
    }
}
if(!empty($_POST["formFieldAdd"])){
    if(ilsEditForm::see('form_field', ilsMain::translit($_POST["formFieldAdd"]["name"])) == 'N'){
        ilsEditForm::add('form_field', $_POST["formFieldAdd"]);
        $ok = 'Поле успешно создано';
    } else {
        $error = 'Такое поле уже существует';
    }
}
?>