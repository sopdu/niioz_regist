<?php
require_once ($_SERVER["DOCUMENT_ROOT"].'/sopdu/modules/list.php');
require_once ($_SERVER["DOCUMENT_ROOT"].'/sopdu/modules/formEdit.php');
?>
<?if($_POST["type"] == 'number'):?>
    <label for="listSort" class="col-sm-3 control-label">Интервал вводимого числа <small><mark style="color: forestgreen;">не обязательное значение <span style="color: red">только цифры</span></mark></small></label>
    <div class="col-sm-9">
        <div class="col-sm-5">
            <div class="form-group">
                <label for="formNumberMin" class="col-sm-9 control-label">Минимальное число</label>
                <div class="col-sm-3">
                    <input type="number" class="form-control" name="formFieldAdd[type_option][number][min]" id="formNumberMin" />
                </div>
            </div>
        </div>
        <div class="col-sm-5">
            <div class="form-group">
                <label for="formNumberMax" class="col-sm-9 control-label">Максимальное число</label>
                <div class="col-sm-3">
                    <input type="number" class="form-control" name="formFieldAdd[type_option][number][max]" id="formNumberMax" />
                </div>
            </div>
        </div>
    </div>
    <div style="clear: both"></div>
    <hr />
<?endif;?>
<?if($_POST["type"] == 'select'):?>
    <div class="form-group">
        <label for="formList" class="col-sm-3 control-label">Выбор списка</label>
        <div class="col-sm-9">
            <select class="form-control" name="formFieldAdd[type_option][list]">
                <?foreach (ilsList::get('list') as $list):?>
                    <option value="<?=$list["id"]?>"><?=$list["name"]?></option>
                <?endforeach;?>
            </select>
        </div>
    </div>
    <hr />
<?endif;?>
<?if($_POST["typeUpdare"]):?>
    <?$zaprosField = ilsEditForm::getById('form_field', $_POST["idUpdate"]);?>
    <table width="100%">
        <tr>
            <td width="50%">
                <?if($_POST["typeUpdare"] == 'select'):?>
                    <select class="form-control" name="updateFields[type_option][list]">
                        <?foreach (ilsList::get('list') as $list):?>
                            <option <?if($zaprosField["list"] == $list["id"]):?>selected<?endif;?> value="<?=$list["id"]?>"><?=$list["name"]?></option>
                        <?endforeach;?>
                    </select>
                <?else:?>
                    ---
                <?endif;?>
            </td>
            <td width="50%">
                <?if($_POST["typeUpdare"] == 'number'):?>
                    <input type="number" style="width: 50px; float: left" class="form-control" value="<?=$zaprosField["num_min"]?>" name="updateFields[type_option][number][min]" id="formNumberMin" />
                    <input type="number" style="width: 50px; float: left" class="form-control" value="<?=$zaprosField["num_max"]?>" name="updateFields[type_option][number][max]" id="formNumberMax" />
                    <div style="clear: both"></div>
                <?else:?>
                    ---
                <?endif;?>
            </td>
        </tr>
    </table>
<?endif;?>