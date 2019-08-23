<?php
	class ilsDB{
		public function connect(){
			$setting = [
				"db_name"   =>  'niioz',
				"db_pass"   =>  'niioz',
				"db_server" =>  'localhost'
			];
			try {
				$db = new PDO(
					'mysql:dbname='.$setting["db_name"].';host='.$setting["db_server"].'',
					$setting["db_name"],
					$setting["db_pass"],
					array(
						PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'",
						PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
					)
				);
			} catch (PDOException $e) {
				die($e->getMessage());
			}
			return $db;
		}
		public function seeTable ($tableName){
			$zapros = self::connect()->query("SHOW TABLES LIKE '".$tableName."'");
			if($zapros->fetch(PDO::FETCH_ASSOC)){
				return 'Y';
			} else {
				return 'N';
			}
		}
		public function createTable ($tableName, $fields){
			self::connect()->query("
				create table ".$tableName." (
					id int unsigned auto_increment primary key,
					".implode(', ', $fields)."
				)
			");
			return;
		}
		/* додумать
		public function add($table, $fields){
			$getFieldsZapros = self::connect()->query("show columns from ".$table);
			while ($getFieldsRow = mysqli_fetch_row($getFieldsZapros)){
				$getFields[] = $getFieldsRow;
			}

			return;
		}
		https://snipp.ru/view/109
		*/
		public function get($tableName){
			$zapros = self::connect()->query("select * from ".$tableName);
			while($row = $zapros->fetch(PDO::FETCH_ASSOC)){
				$result[$row["id"]] = $row;
			}
			return $result;
		}
		public function getBy($tableName, $byField, $byValue){
			$zapros = self::connect()->prepare("select * from ".$tableName." where ".$byField."= :byValue");
			$zapros->execute(array('byValue' => $byValue));
			while($row = $zapros->fetch(PDO::FETCH_ASSOC)){
				$result[$row["id"]] = $row;
			}
			return $result;
		}
		public function getById($tableName, $id){
			#ilsMain::dump([$tableName, $id]);
			#return;
			$zapros = self::connect()->query("select * from ".$tableName." where id = '".$id."'");
			return $zapros->fetch(PDO::FETCH_ASSOC);
		}
		public function getBySort($tableName, $byField, $byValue, $sortField = '', $sortValue = ''){
			if(empty($sortValue)){
				$sortValue = 'asc';
			} else {
				$sortValue = $sortValue;
			}
			if(empty($sortField)){
				$sortField = 'sort';
			} else {
				$sortField = $sortField;
			}
			$zapros = self::connect()->prepare("select * from ".$tableName." where ".$byField."= :byValue order by ".$sortField." ".$sortValue);
			$zapros->execute(array('byValue' => $byValue));
			while($row = $zapros->fetch(PDO::FETCH_ASSOC)){
				$result[$row["id"]] = $row;
			}
			return $result;
		}
		public function getBySortGroup($tableName, $byField = '', $byValue = ''){
			if(empty($byValue)){
				$byValue = 'asc';
			} else {
				$byValue = $byValue;
			}
			if(empty($byField)){
				$byField = 'sort';
			} else {
				$byField = $byField;
			}
			$zapros = self::connect()->query("select * from ".$tableName." order by ".$byField." ".$byValue);
			while($row = $zapros->fetch(PDO::FETCH_ASSOC)){
				$result[$row["id"]] = $row;
			}
			return $result;
		}
		public function seeItem($tableName, $elementCode){
			$zapros = self::connect()->prepare("select id from ".$tableName." where code= :elementCode");
			$zapros->execute(array('elementCode' => $elementCode));
			if($zapros->fetch(PDO::FETCH_ASSOC)){
				return 'Y';
			} else {
				return 'N';
			}
		}
		public function drop($tableName, $itemId){
			self::connect()->query("delete from ".$tableName." where id =".$itemId);
			return;
		}
		public function dropGroup($tableName, $dropField, $dropValue){
			self::connect()->query("delete from ".$tableName." where ".$dropField." = ".$dropValue);
			return;
		}
	}
?>
