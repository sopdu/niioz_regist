<?php require_once ($_SERVER["DOCUMENT_ROOT"].'/sopdu/modules/list.php');
if(empty($returnRes)){
    $returnRes = $_GET["list"];
}
?>
<div class="row">
    <div class="col-md-12">
        <div class="alert alert-info alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>Списки</strong> являются вариантами полей формы когда требуется выбрать один или несколько пунктов не вводя значения в ручную
        </div>
    </div>
</div>
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
            <div class="panel-heading">Создание нового списка</div>
            <div class="panel-body">
                <form class="form-horizontal" method="post">
                    <div class="form-group">
                        <label for="listName" class="col-sm-2 control-label">Название списка</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="listAdd[name]" id="listName" placeholder="Название списка" />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox"  name="listAdd[multilevel]" /> Список может принимать множественные значения
                                </label>
                            </div>
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
            <div class="panel-heading">Значение списков</div>
            <div class="panel-body">
                <div class="col-xs-3">
                    <h3>Списки</h3>
                    <hr />
                    <ul class="nav nav-tabs tabs-left">
                        <?foreach (ilsList::get('list') as $list):?>
                            <li <?if($list["id"] == $returnRes):?>class="active"<?endif;?>><a href="#<?=$list["id"]?>" data-toggle="tab"><?=$list["name"]?></a></li>
                        <?endforeach;?>
                    </ul>
                </div>
                <div class="col-xs-9">
                    <h3>Значения</h3>
                    <hr />
                    <div class="tab-content">
                        <?foreach (ilsList::get('list') as $list):?>
                            <div class="tab-pane <?if($list["id"] == $returnRes):?>active<?endif;?>" id="<?=$list["id"]?>">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
											<th>#</th>
                                            <th>name</th>
                                            <th>code</th>
											<th>sort</th>
                                            <th>action</th>
                                        </tr>
                                    </thead>
									<tbody>
										<?$num = 1?>
										<?foreach (ilsList::getBySort('list_item', 'list_id', $list["id"]) as $item):?>
                                            <?if($item["id"] == $_GET["update"]):?>
                                                <form method="post">
                                                    <tr>
                                                        <td><?=$num++?></td>
                                                        <td>
                                                            <input class="form-control" type="text" value="<?=$item["name"]?>" name="updateItem[name]" />
                                                        </td>
                                                        <td>
                                                            <input class="form-control" type="text" value="<?=$item["code"]?>" name="updateItem[code]" />
                                                        </td>
                                                        <td>
                                                            <input class="form-control" type="number" value="<?=$item["sort"]?>" name="updateItem[sort]" />
                                                        </td>
                                                        <td>
                                                            <input type="hidden" value="<?=$item["id"]?>" name="updateItem[itemId]" />
                                                            <input type="hidden" value="<?=$list["id"]?>" name="updateItem[listId]" />
                                                            <button type="submit" class="btn btn-success"><i class="glyphicon glyphicon-ok"></i></button>
                                                        </td>
                                                    </tr>
                                                </form>
                                            <?else:?>
                                                <tr>
                                                    <td><?=$num++?></td>
                                                    <td><?=$item["name"]?></td>
                                                    <td><?=$item["code"]?></td>
                                                    <td><?=$item["sort"]?></td>
                                                    <td>
                                                        <a href="?update=<?=$item["id"]?>&list=<?=$list["id"]?>" class="btn btn-default" data-toggle="tooltip" data-placement="top" title="Изменить значение">
                                                            <i class="glyphicon glyphicon-pencil"></i>
                                                        </a>
                                                        <a href="?delete=<?=$item["id"]?>&list=<?=$list["id"]?>" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Удалить значение">
                                                            <i class="glyphicon glyphicon-trash"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            <?endif?>
                                        <?endforeach;?>
									</tbody>
                                </table>
                                <div class="panel panel-default">
                                    <div class="panel-heading">Добавление значения в список "<?=$list["name"]?>"</div>
                                    <div class="panel-body">
                                        <form class="form-horizontal" method="post">
                                            <div class="form-group">
                                                <label for="listName" class="col-sm-3 control-label">Значение <small><mark>обязательное поле</mark></small></label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" name="itemListAdd[name]" id="listName" placeholder="Значение списка" />
                                                </div>
                                            </div>
                                            <hr />
                                            <div class="form-group">
                                                <label for="listCode" class="col-sm-3 control-label">Код <small><mark style="color: forestgreen;">не обязательное значение <span style="color: red">литинские символы без пробелов</span></mark></small></label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" name="itemListAdd[code]" id="listCode" placeholder="Код значения списка (не обязательное значение)" />
                                                </div>
                                            </div>
                                            <hr />
                                            <div class="form-group">
                                                <label for="listSort" class="col-sm-3 control-label">Порядок сортировки <small><mark style="color: forestgreen;">не обязательное значение <span style="color: red">только цифры</span></mark></small></label>
                                                <div class="col-sm-9">
                                                    <input type="number" class="form-control" name="itemListAdd[sort]" id="listCode" value="100" placeholder="Код значения списка (не обязательное значение)" />
                                                </div>
                                            </div>
                                            <hr />
                                            <div class="form-group">
                                                <div class="col-sm-offset-3 col-sm-9">
                                                    <input type="hidden" name="itemListAdd[listID]" value="<?=$list["id"]?>" />
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
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div  class="col-sm-12">
        <div class="panel panel-default">
            <div class="panel-heading">Управление списками</div>
            <div class="panel-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>name</th>
                            <th>code</th>
                            <th>Множественное</th>
                            <th>action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?$num = 1?>
                        <?foreach (ilsList::get('list') as $list):?>
                            <?if($list["id"] == $_GET["updateList"]):?>
                                <form method="post">
                                    <tr>
                                        <td><?=$num++?></td>
                                        <td>
                                            <input type="text" class="form-control" name="updateList[name]" value="<?=$list["name"]?>" />
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" name="updateList[code]" value="<?=$list["code"]?>" />
                                        </td>
                                        <td>
                                            <?if($list["multilevel"] == 'Y'){
                                                $checked = 'checked';
                                            } else {
                                                $checked = '';
                                            }?>
                                            <input type="checkbox" name="updateList[multilevel]" <?=$checked?> />
                                        </td>
                                        <td>
                                            <input type="hidden" name="updateList[id]" value="<?=$list["id"]?>" />
                                            <button type="submit" class="btn btn-success"><i class="glyphicon glyphicon-ok"></i></button>
                                        </td>
                                    </tr>
                                </form>
                            <?else:?>
                                <tr>
                                    <td><?=$num++?></td>
                                    <td><?=$list["name"]?></td>
                                    <td><?=$list["code"]?></td>
                                    <td>
                                        <?if($list["multilevel"] == 'Y'):?>
                                            Да
                                        <?else:?>
                                            Нет
                                        <?endif;?>
                                    </td>
                                    <td>
                                        <a href="?updateList=<?=$list["id"]?>" class="btn btn-default" data-toggle="tooltip" data-placement="top" title="Изменить значение">
                                            <i class="glyphicon glyphicon-pencil"></i>
                                        </a>
                                        <a href="?deleteLise=<?=$list["id"]?>" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Удалить значение">
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
<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>