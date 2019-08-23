<?php
require_once ($_SERVER["DOCUMENT_ROOT"].'/sopdu/modules/formEdit.php');
require_once ($_SERVER["DOCUMENT_ROOT"].'/sopdu/modules/list.php');
?>
<?if(!empty($error)):?>
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong><?=$error?></strong>
            </div>
        </div>
    </div>
<?endif;?>
<?if(!empty($ok)):?>
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <?=$ok?>
            </div>
        </div>
    </div>
<?endif;?>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">Создание новой формы</div>
            <div class="panel-body">
                <form class="form-horizontal" method="post">
                    <div class="form-group">
                        <label for="formName" class="col-sm-2 control-label">Название новой формы</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="formAdd[name]" id="formName" placeholder="Название новой формы" />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-default">Сохранить</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div  class="col-sm-12">
        <div class="panel panel-default">
            <div class="panel-heading">Поля форм</div>
            <div class="panel-body">
                <div class="col-xs-3">
                    <h3>Формы</h3>
                    <hr />
                    <ul class="nav nav-tabs tabs-left">
                        <?foreach (ilsEditForm::get('form') as $form):?>
                            <li <?if($form["id"] == $_GET["form"]):?>class="active"<?endif;?>><a href="#<?=$form["id"]?>" data-toggle="tab"><?=$form["name"]?></a></li>
                        <?endforeach;?>
                    </ul>
                </div>
                <div class="col-xs-9">
                    <h3>Поля формы</h3>
                    <hr />
                    <div class="tab-content">
                        <?foreach (ilsEditForm::get('form') as $form):?>
                            <div class="tab-pane <?if($form["id"] == $_GET["form"]):?>active<?endif;?>" id="<?=$form["id"]?>">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Поле</th>
                                            <th>Код поля</th>
                                            <th>Тип поля</th>
                                            <th>Список</th>
                                            <th>Число / интервал</th>
                                            <th>Обязательное</th>
                                            <th>Сортировка</th>
                                            <th>Действия</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?$num = 1?>
                                        <?foreach (ilsEditForm::getBySort('form_field', 'form_id', $form["id"]) as $field):?>
                                            <?/*if($field["id"] == $_GET["updateField"]):?>
                                                <form method="post">
                                                    <tr>
                                                        <td><?=$num++?></td>
                                                        <td>
                                                            <input class="form-control" type="text" value="<?=$field["name"]?>" name="updateFields[name]" />
                                                        </td>
                                                        <td>
                                                            <input class="form-control" type="text" value="<?=$field["code"]?>" name="updateFields[code]" />
                                                        </td>
                                                        <td>
                                                            <script type="text/javascript">
                                                                function typeFieldSelectUpdate(){
                                                                    var type = $('select[name="updateFields[type]"]').val();
                                                                    $.ajax({
                                                                        type: "POST",
                                                                        url: "/sopdu/template/modules/formEdit/ajax.php",
                                                                        data: {typeUpdare: type, idUpdate: <?=$field["id"]?>},
                                                                        success: function(data){ $(".ajaxUpdate").html(data); }
                                                                    });
                                                                };
                                                            </script>
                                                            <select class="form-control" name="updateFields[type]" onchange="javascript:typeFieldSelectUpdate();">
                                                                <option <?if($field["type"] == 'text'):?>selected<?endif;?> value="text">Строка</option>
                                                                <option <?if($field["type"] == 'textarea'):?>selected<?endif;?> value="textarea">Большой текст</option>
                                                                <option <?if($field["type"] == 'number'):?>selected<?endif;?> value="number">Число</option>
                                                                <option <?if($field["type"] == 'select'):?>selected<?endif;?> value="select">Список</option>
                                                                <option <?if($field["type"] == 'checkbox'):?>selected<?endif;?> value="checkbox">Галочка</option>
                                                                <option <?if($field["type"] == 'date'):?>selected<?endif;?> value="date">Дата</option>
                                                                <option <?if($field["type"] == 'phone'):?>selected<?endif;?> value="phone">Телефон</option>
                                                                <option <?if($field["type"] == 'email'):?>selected<?endif;?> value="email">E-Mail</option>
                                                                <option <?if($field["type"] == 'datetime'):?>selected<?endif;?> value="datetime">Дата / Время</option>
                                                            </select>
                                                        </td>
                                                        <td colspan="2" class="ajaxUpdate">
                                                            <table width="100%">
                                                                <tr>
                                                                    <td width="50%">11</td>
                                                                    <td width="50%">2</td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                        <td>
                                                            <?
                                                                if($field["required"] == 'Y'){
                                                                    $checked = 'checked';
                                                                } else {
                                                                    $checked = '';
                                                                }
                                                            ?>
                                                            <input type="checkbox" <?=$checked?> name="updateFields[required]" />
                                                        </td>
                                                        <td>
                                                            <input class="form-control" style="width: 70px" size="3" type="number" value="<?=$field["sort"]?>" name="updateFields[sort]" />
                                                        </td>
                                                        <td>
                                                            <button type="submit" class="btn btn-success"><i class="glyphicon glyphicon-ok"></i></button>
                                                        </td>
                                                    </tr>
                                                </form>
                                            <?else:*/?>
                                                <tr>
                                                    <td><?=$num++?></td>
                                                    <td><?=$field["name"]?></td>
                                                    <td><?=$field["code"]?></td>
                                                    <td><?=$field["type"]?></td>
                                                    <td>
                                                        <?if($field["list"] != 0):?>
                                                            <?=ilsList::getById('list', $field["list"])["name"]?>
                                                        <?else:?>
                                                            ---
                                                        <?endif;?>
                                                    </td>
                                                    <td>
                                                        <?if($field["num_min"] != 0 || $field["num_max"] != 0):?>
                                                            <?=$field["num_min"]?> - <?=$field["num_max"]?>
                                                        <?else:?>
                                                            ---
                                                        <?endif;?>
                                                    </td>
                                                    <td>
                                                        <?if($field["required"] == 'Y'):?>
                                                            Да
                                                        <?endif;?>
                                                        <?if($field["required"] == 'N'):?>
                                                            Нет
                                                        <?endif;?>
                                                    </td>
                                                    <td><?=$field["sort"]?></td>
                                                    <td>
                                                        <?/*
                                                        <a href="?updateField=<?=$field["id"]?>&form=<?=$form["id"]?>" class="btn btn-default" data-toggle="tooltip" data-placement="top" title="Изменить поле">
                                                            <i class="glyphicon glyphicon-pencil"></i>
                                                        </a>
                                                        */?>
                                                        <a href="?deleteField=<?=$field["id"]?>&form=<?=$form["id"]?>" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Удалить поле">
                                                            <i class="glyphicon glyphicon-trash"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            <?#endif;?>
                                        <?endforeach;?>
                                    </tbody>
                                </table>
                                <div class="panel panel-default">
                                    <div class="panel-heading">Добавление поля в форму "<?=$form["name"]?>"</div>
                                    <div class="panel-body">
                                        <form class="form-horizontal" method="post">
                                            <div class="form-group">
                                                <label for="fieldName" class="col-sm-3 control-label">Имя поля <small><mark>обязательное поле</mark></small></label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" name="formFieldAdd[name]" id="fieldName" placeholder="Имя поля" />
                                                </div>
                                            </div>
                                            <hr />
                                            <div class="form-group">
                                                <label for="fieldCode" class="col-sm-3 control-label">Код <small><mark style="color: forestgreen;">не обязательное значение <span style="color: red">литинские символы без пробелов</span></mark></small></label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" name="formFieldAdd[code]" id="fieldCode" placeholder="Код (не обязательное поле)" />
                                                </div>
                                            </div>
                                            <hr />
                                            <div class="form-group">
                                                <label for="fieldType" class="col-sm-3 control-label">Тип поля <small><mark style="color: red">обязательное поле</mark></small></label>
                                                <div class="col-sm-9">
                                                    <script type="text/javascript">
                                                        function typeFieldSelect(){
                                                            var type = $('select[name="formFieldAdd[type]"]').val();
                                                            $.ajax({
                                                                type: "POST",
                                                                url: "/sopdu/template/modules/formEdit/ajax.php",
                                                                data: {type: type},
                                                                success: function(data){ $(".ajax").html(data); }
                                                            });
                                                        };
                                                    </script>
                                                    <select class="form-control" name="formFieldAdd[type]" onchange="javascript:typeFieldSelect();">
                                                        <option value="text">Строка</option>
                                                        <option value="textarea">Большой текст</option>
                                                        <option value="number">Число</option>
                                                        <option value="select">Список</option>
                                                        <option value="checkbox">Галочка</option>
                                                        <option value="date">Дата</option>
                                                        <option value="phone">Телефон</option>
                                                        <option value="email">E-Mail</option>
                                                        <option value="datetime">Дата / Время</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <hr />
                                            <div class="ajax"></div>
                                            <div class="form-group">
                                                <label for="listSort" class="col-sm-3 control-label">Порядок сортировки <small><mark style="color: forestgreen;">не обязательное значение <span style="color: red">только цифры</span></mark></small></label>
                                                <div class="col-sm-9">
                                                    <input type="number" class="form-control" name="formFieldAdd[sort]" id="listCode" value="100" placeholder="Код значения списка (не обязательное значение)" />
                                                </div>
                                            </div>
                                            <hr />
                                            <div class="form-group">
                                                <div class="col-sm-offset-3 col-sm-9">
                                                    <div class="checkbox">
                                                        <label>
                                                            <input type="checkbox"  name="formFieldAdd[required]" /> Обязательное поле
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr />
                                            <div class="form-group">
                                                <div class="col-sm-offset-3 col-sm-9">
                                                    <input type="hidden" name="formFieldAdd[formId]" value="<?=$form["id"]?>" />
                                                    <button type="submit" class="btn btn-default">Сохранить</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        <?endforeach;?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div  class="col-sm-12">
        <div class="panel panel-default">
            <div class="panel-heading">Управление формами</div>
            <div class="panel-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>name</th>
                            <th>code</th>
                            <th>action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?$num = 1?>
                        <?foreach (ilsEditForm::get('form') as $form):?>
                            <?if($form["id"] == $_GET["updateForm"]):?>
                                <form method="post">
                                    <tr>
                                        <td><?=$num++?></td>
                                        <td>
                                            <input type="text" class="form-control" name="updateForm[name]" value="<?=$form["name"]?>" />
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" name="updateForm[code]" value="<?=$form["code"]?>" />
                                        </td>
                                        <td>
                                            <input type="hidden" name="updateForm[id]" value="<?=$form["id"]?>" />
                                            <button type="submit" class="btn btn-success"><i class="glyphicon glyphicon-ok"></i></button>
                                        </td>
                                    </tr>
                                </form>
                            <?else:?>
                                <tr>
                                    <td><?=$num++?></td>
                                    <td><?=$form["name"]?></td>
                                    <td><?=$form["code"]?></td>
                                    <td>
                                        <a href="?updateForm=<?=$form["id"]?>" class="btn btn-default" data-toggle="tooltip" data-placement="top" title="Изменить форму">
                                            <i class="glyphicon glyphicon-pencil"></i>
                                        </a>
                                        <a href="?deleteForm=<?=$form["id"]?>" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Удалить форму">
                                            <i class="glyphicon glyphicon-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?endif;?>
                        <?endforeach;?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>