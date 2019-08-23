<!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <?/*<meta name="viewport" content="width=device-width, initial-scale=1">*/?>
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
            <!-- Выше 3 Мета-теги ** должны прийти в первую очередь в голове; любой другой руководитель контент *после* эти теги -->
            <?# require_once($_SERVER["DOCUMENT_ROOT"] . '/class/ilsMain.php') ?>
            <title>function getTitle</title>

            <!-- Bootstrap -->
            <link href="../sopdu/template/css/bootstrap.min.css" rel="stylesheet">

            <!-- ils styles -->
            <link href="../sopdu/template/css/main.css" rel="stylesheet">


            <!-- HTML5 Shim and Respond.js for IE8 support of HTML5 elements and media queries -->
            <!-- Предупреждение: Respond.js не работает при просмотре страницы через файл:// -->
            <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script >
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
            <![endif]-->

            <!-- на jQuery (необходим для Bootstrap - х JavaScript плагины) -->
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        </head>
        <body>
        <?
            ilsMain::getmodule('login');
            $expPath = explode('/', $_SERVER["REQUEST_URI"]);
            if($expPath[1] == 'adm'){
                ilsMain::getModule('navbar');
            }
        ?>
        <div class="container-fluid" style="padding-top:60px">