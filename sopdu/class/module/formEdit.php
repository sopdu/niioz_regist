<?
    require_once ($_SERVER["DOCUMENT_ROOT"].'/sopdu/class/ilsMain.php');
    class ilsEditForm {
        public function add($tableName, $item){
            if($tableName == 'form'){
                if(ilsDB::seeTable($tableName) == 'N'){
                    ilsDB::createTable(
                        $tableName,
                        $field = [
                            "name text not null",
                            "code text not null"
                        ]
                    );
                }
                ilsDB::connect()->query("
                    insert into form (
                        name, code
                    ) values (
                        '".$item["name"]."', '".ilsMain::translit($item["name"])."'
                    )
                ");
            }
            if($tableName == 'form_field'){
                if(ilsDB::seeTable($tableName) == 'N'){
                    ilsDB::createTable(
                        $tableName,
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
                }
                if(empty($item)){
                    $code = ilsMain::translit($item["name"]);
                } else {
                    $code = $item["code"];
                }
                if(!empty($item["type_option"]["list"])){
                    $list = $item["type_option"]["list"];
                } else {
                    $list = null;
                }
                if(!empty($item["type_option"]["number"])){
                    if(!empty($item["type_option"]["number"]["min"])){
                        $num_nim = $item["type_option"]["number"]["min"];
                    } else {
                        $num_nim = null;
                    }
                    if(!empty($item["type_option"]["number"]["max"])){
                        $num_max = $item["type_option"]["number"]["max"];
                    } else {
                        $num_max = null;
                    }
                }
                if($item["required"] == 'on'){
                    $sort = 'Y';
                } else {
                    $sort = 'N';
                }
                ilsDB::connect()->query("
                    insert into form_field (
                        form_id, name, code, type, list, num_min, num_max, sort, required
                    ) values (
                        '".$item["formId"]."', '".$item["name"]."', '".$code."', '".$item["type"]."', '".(int)$list."', '".(int)$num_nim."', '".(int)$num_max."', '".$item["sort"]."', '".$sort."'
                    )
                ");

                /*
                 Array
(
    [formFieldAdd] => Array
        (
            [name] => выфвыфв
            [code] => выфвыфвыфв
            [type] => Array
                (
                    [number] => Array
                        (
                            [min] => 2
                            [max] => 2222
                        )

                )

            [sort] => 100
            [required] => on
            [formId] => 4
        )

)
Array
(
    [formFieldAdd] => Array
        (
            [name] => выфвыфв
            [code] => выфвыфвыфв
            [type] => Array
                (
                    [number] => Array
                        (
                            [min] => 2
                            [max] => 2222
                        )

                )

            [sort] => 100
            [required] => on
            [formId] => 4
        )

)


 Array
(
    [formFieldAdd] => Array
        (
            [name] => sadsad
            [code] => dsasad
            [type] => Array
                (
                    [list] => 7
                )

            [sort] => 100
            [formId] => 4
        )

)
Array
(
    [formFieldAdd] => Array
        (
            [name] => dsadsa
            [code] => dsad
            [type] => Array
                (
                    [number] => Array
                        (
                            [min] => 1
                            [max] => 2
                        )

                )

            [sort] => 100
            [formId] => 4
        )

)

                 * */
            }
            return;
        }
        public function see($tableName, $code){
            return ilsDB::seeItem($tableName, $code);
        }
        public function get($tableName){
            return ilsDB::get($tableName);
        }
        public function getBySort($tableName, $byField, $byValue, $sortField = '', $sortValue = ''){
            return ilsDB::getBySort($tableName, $byField, $byValue, $sortField = '', $sortValue = '');
        }
        public function getById($tableName, $id){
            return ilsDB::getById($tableName, $id);
        }
        public function drop($tableName, $id){
            return ilsDB::drop($tableName, $id);
        }
        public function updateForm($fields){
            ilsDB::connect()->query("
                update form set
                    name = '".$fields["name"]."',
                    code = '".$fields["code"]."'
                where
                    id =".$fields["id"]
            );
            return;
        }
    }
?>