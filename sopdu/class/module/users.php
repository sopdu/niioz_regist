<?php
	require_once ($_SERVER["DOCUMENT_ROOT"].'/sopdu/class/ilsMain.php');
	class ilsUsers {
		public function organizationGetByCode($code){
			return ilsDB::getBy('organization', 'code', $code);
		}
		public function organizationAdd($name, $admin, $form_see, $form_edit){
			ilsDB::connect()->query("
				insert into organization (
					name, code, admin, form_see, form_edit
				) values (
					'".$name."', '".ilsMain::translit($name)."', '".$admin."', '".$form_see."', '".$form_edit."'
				)
			");
			return;
		}
		public function userAdd($login, $pass, $organization, $email, $phone = '', $name = '', $surname = '', $patronymic = ''){
            ilsDB::connect()->query("
                insert into user (
                    name, pass, organization, p_name, p_surname, p_patronymic, email, phone
                ) values (
                    '".$login."', '".md5($pass)."', '".$organization."', '".$name."', '".$surname."', '".$patronymic."', '".$email."', '".$phone."'
                )
            ");
            return;
        }
		public function organizationGet(){
		    return ilsDB::getBySortGroup('organization', 'name', '');
        }
        public function usersGet($organization){
			return ilsDB::getBySort('user', 'organization', $organization, 'p_surname', '');
        }
        public function usersGetFirstName(){
		    return 'user_'.++end(ilsDB::get('user'))["id"];
        }
        public function userGetLogin($login){
		    return ilsDB::getBy('user', 'name', $login);
        }
        public function userDrop($id){
		    return ilsDB::drop('user', $id);
        }
	}
?>