<?php require_once ($_SERVER["DOCUMENT_ROOT"].'/sopdu/modules/users.php'); ?>
<div class="row">
	<div class="col-md-12">
		<div class="alert alert-info alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<strong>Организации</strong> являются группами пользователей. Права назначаются на группу (организацию)
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
			<div class="panel-heading">Создание организации</div>
			<div class="panel-body">
				<form class="form-horizontal" method="post">
					<div class="form-group">
						<label for="organizationName" class="col-sm-2 control-label">Называние организации</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="organizationAdd[name]" id="organizationName" placeholder="Название организации" />
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
							<div class="checkbox">
								<label>
									<input type="checkbox" name="organizationAdd[adm]" /> Доступ в админ-панель
								</label>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
							<div class="checkbox">
								<label>
									<input type="checkbox" name="organizationAdd[formAll]" /> Может просматривать формы заполненные другими организациями
								</label>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-2 col-lg-10">
							<div class="checkbox">
								<label>
									<input type="checkbox" name="organizationAdd[formEdit]" /> Может вносить правки в ранее заполненые формы
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
	<div class="col-sm-12">
		<div class="panel panel-default">
			<div class="panel-heading">Пользователи</div>
			<div class="panel-body">
				<div class="col-xs-3">
                    <h3>Организации</h3>
                    <hr />
                    <ul class="nav nav-tabs tabs-left">
                        <?foreach (ilsUsers::organizationGet() as $organizationGet):?>
                            <li <?if($organizationGet["id"] == $_GET["organization"]):?>class="active"<?endif;?>><a href="#<?=$organizationGet["id"]?>" data-toggle="tab"><?=$organizationGet["name"]?></a></li>
                        <?endforeach;?>
                    </ul>
                </div>
				<div class="col-xs-9">
                    <h3>Пользователи</h3>
                    <hr />
                    <div class="tab-content">
                        <?foreach (ilsUsers::organizationGet() as $organizationGet):?>
                            <div class="tab-pane <?if($organizationGet["id"] == $_GET["organization"]):?>active<?endif;?>" id="<?=$organizationGet["id"]?>">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Логин</th>
                                            <th>E-Mail</th>
                                            <th>Телефон</th>
                                            <th>Фамилия</th>
                                            <th>Имя</th>
                                            <th>Отчество</th>
                                            <th>Действия</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?$num = 1?>
                                        <?#=ilsUsers::usersGet($organizationGet["id"])?>
                                        <?#='<pre>'; print_r(ilsUsers::usersGet($organizationGet["id"])); '</pre>';?>
                                        <?foreach (ilsUsers::usersGet($organizationGet["id"]) as $users):?>
											<?if($_GET["updateUser"] === $users["id"]):?>
												<tr>
													<form method="post">
													
													</form>
												</tr>
	                                        <?else:?>
												<tr>
													<td><?=$num++?></td>
													<td><?=$users["name"]?></td>
													<td><?=$users["email"]?></td>
													<td><?=$users["phone"]?></td>
													<td><?=$users["p_surname"]?></td>
													<td><?=$users["p_name"]?></td>
													<td><?=$users["p_patronymic"]?></td>
													<td>
														<a href="?updateUser=<?=$users["id"]?>&organization=<?=$organizationGet["id"]?>" class="btn btn-default" data-toggle="tooltip" data-placement="top" title="Изменить пользователя">
															<i class="glyphicon glyphicon-pencil"></i>
														</a>
														<a href="?deleteUser=<?=$users["id"]?>&organization=<?=$organizationGet["id"]?>" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Удалить польхователя">
															<i class="glyphicon glyphicon-trash"></i>
														</a>
													</td>
												</tr>
											<?endif;?>
                                        <?endforeach;?>
                                    </tbody>
                                </table>
                                <div class="panel panel-default">
                                    <div class="panel-heading">Добавление пользователя в организацию "<?=$organizationGet["name"]?>"</div>
                                    <div class="panel-body">
										<form class="form-horizontal" method="post">
											<div class="form-group">
                                                <label for="userLogin" class="col-sm-3 control-label">Логин <small><mark style="color: red">латинские символы без проблелов и знаков припинания</mark></small></label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" name="userAdd[login]" id="userLogin" placeholder="Логин" value="<?=ilsUsers::usersGetFirstName()?>" />
                                                </div>
											</div>
                                            <hr />
                                            <div class="form-group">
                                                <label for="userPass" class="col-sm-3 control-label">Пароль <small><mark style="color: forestgreen;">По умолчанию: 123456</mark></small></label>
                                                <div class="col-sm-9">
                                                    <input type="password" class="form-control" name="userAdd[pass]" id="userPass" placeholder="Пароль" value="123456" />
                                                </div>
                                            </div>
                                            <hr />
                                            <div class="form-group">
                                                <label for="userPassReplay" class="col-sm-3 control-label">Поаторите пароль <small><mark style="color: red">Значение поля должно быть индентично значению поля "Пароль"</mark><mark style="color: forestgreen;">По умолчанию: 123456</mark></small></label>
                                                <div class="col-sm-9">
                                                    <input type="password" class="form-control" name="userAdd[passReplay]" id="userPassReplay" placeholder="Повторите пароль" value="123456" />
                                                </div>
                                            </div>
                                            <hr />
                                            <div class="form-group">
                                                <label for="userEmail" class="col-sm-3 control-label">E-Mail <small><mark style="color: red">Обязательное поле</mark></small></label>
                                                <div class="col-sm-9">
                                                    <input type="email" class="form-control" name="userAdd[email]" id="userEmail" placeholder="email@email.com" />
                                                </div>
                                            </div>
                                            <hr />
                                            <div class="form-group">
                                                <label for="userPhone" class="col-sm-3 control-label">Телефон</label>
                                                <div class="col-sm-9">
                                                    <input type="tel" class="form-control" name="userAdd[phone]" id="userPhone" placeholder="+73211234567" />
                                                </div>
                                            </div>
                                            <hr />
                                            <div class="form-group">
                                                <label for="userName" class="col-sm-3 control-label">Имя</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" name="userAdd[name]" id="userName" placeholder="Имя пользователя" />
                                                </div>
                                            </div>
                                            <hr />
                                            <div class="form-group">
                                                <label for="userPatronymic" class="col-sm-3 control-label">Отчество</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" name="userAdd[patronymic]" id="userPatronymic" placeholder="Отчество пользователя" />
                                                </div>
                                            </div>
                                            <hr />
                                            <div class="form-group">
                                                <label for="userSurname" class="col-sm-3 control-label">Фамилия</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" name="userAdd[surname]" id="userSurname" placeholder="Фамилия пользователя" />
                                                </div>
                                            </div>
                                            <hr />
                                            <div class="form-group">
                                                <div class="col-sm-offset-3 col-sm-9">
                                                    <input type="hidden" name="userAdd[organization]" value="<?=$organizationGet["id"]?>" />
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
            <div class="panel-heading">Управление организациями (группами)</div>
            <div class="panel-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Организация</th>
                            <th>Доступ в админ-панель</th>
                            <th>Просматривать формы заполненные другими организациями</th>
                            <th>Вносить правки в ранее заполненые формы</th>
                            <tр>Действия</tр>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>