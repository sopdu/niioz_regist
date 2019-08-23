<?php

require_once ($_SERVER["DOCUMENT_ROOT"].'/sopdu/class/ilsMain.php');
/*
ilsDB::createTable(
    'form_field',
    $field = [
        "form_id int not null",
        "name text not null",
        "code text not null",
        "type char(8) not null",
        "list int",
        "num_min int",
        "num_max int",
        "sort int",
        "required char(1) not null"
    ]
);

123
*/
/*
ilsDB::createTable(
    'user',
    $field = [
        "name text not null",
        "pass text not null"
    ]
);
ilsDB::connect()->query("
    insert into user (
        name, pass
    ) values (
        'admin', '" . md5('123456'). "'
    )
");
e10adc3949ba59abbe56e057f20f883e
*/