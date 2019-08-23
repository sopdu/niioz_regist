<?php
    require_once ($_SERVER["DOCUMENT_ROOT"].'/sopdu/class/ilsMain.php');
    class ilsList {
        public function add($tableName, $item){
            if($tableName == 'list') {
                if (ilsDB::seeTable($tableName) == 'N') {
                    ilsDB::createTable(
                        $tableName,
                        $field = [
                            "name text not null",
                            "code text not null",
                            "multilevel char(1) not null"
                        ]
                    );

                }
                if ($item["multilevel"] == 'on') {
                    $multilevel = 'Y';
                } else {
                    $multilevel = 'N';
                }
                ilsDB::connect()->query("
                    insert into list (
                        name, code, multilevel
                    ) values (
                        '" . $item["name"] . "', '" . ilsMain::translit($item["name"]) . "', '" . $multilevel . "'
                    )
                ");
            }
            if($tableName == 'list_item'){
                if (ilsDB::seeTable($tableName) == 'N') {
                    ilsDB::createTable(
                        $tableName,
                        $field = [
                            "list_id int",
                            "name text not null",
                            "code text not null",
	                        "sort int"
                        ]
                    );
                }
                if(empty($item["code"])){
                	$itemCode = ilsMain::translit($item["name"]);
                } else {
	                $itemCode = $item["code"];
                }
                ilsDB::connect()->query("
                    insert into list_item (
                    	list_id, name, code, sort
                    ) values (
                    	'".$item["listID"]."', '".$item["name"]."', '".$itemCode."', '".$item["sort"]."'
                    )
                ");
            }
            return;
        }
        public function seeItem($tableName, $itemCode){
            return ilsDB::seeItem($tableName, $itemCode);
        }
        public function get($tableName){
            return ilsDB::get($tableName);
        }
        public function getBy($tableName, $byField, $byValue){
        	return ilsDB::getBy($tableName, $byField, $byValue);
        }
        public function getById($tableName, $id){
            return ilsDB::getById($tableName, $id);
        }
        public function getBySort($tableName, $byField, $byValue, $sortField = '', $sortValue = ''){
            return ilsDB::getBySort($tableName, $byField, $byValue, $sortField = '', $sortValue = '');
        }
        public function drop($tableName, $itemId){
        	return ilsDB::drop($tableName, $itemId);
        }
        public function dropItems($tableName, $dropField, $dropValue){
            return ilsDB::dropGroup($tableName, $dropField, $dropValue);
        }
        public function updateItem($fields){
        	ilsDB::connect()->query("
        	    update list_item set
        	        name = '".$fields["name"]."', 
        	        code = '".$fields["code"]."',
        	        sort = '".$fields["sort"]."'
        	    where
        	        id=".$fields["itemId"]
            );
        	return;
        }
        public function updateList($fields){
            if($fields["multilevel"] == 'on'){
                $multilevel = 'Y';
            } else {
                $multilevel = 'N';
            }
            ilsDB::connect()->query("
                update list set
                    name = '".$fields["name"]."', 
                    code = '".$fields["code"]."',
                    multilevel = '".$multilevel."'
                where
                    id=".$fields["id"]
            );
            return;
        }
    }
?>