<?php
    require_once ('ilsDB.php');
	class ilsMain {
		public function getList(){
			require_once($_SERVER["DOCUMENT_ROOT"] . '/class/ilsList.php');
			
		}
		public function getListByID($id){
		
		}
		public function getHeader(){
		    return require  ($_SERVER["DOCUMENT_ROOT"].'/sopdu/template/header.php');
        }
        public function getFooter(){
            return require  ($_SERVER["DOCUMENT_ROOT"].'/sopdu/template/footer.php');
        }
		public function getModule($module){
            return require ($_SERVER["DOCUMENT_ROOT"].'/sopdu/template/modules/'.$module.'/template.php');
        }
        public function dump($value){
            $filePath = $_SERVER["DOCUMENT_ROOT"].'/ilsDump.txt';
            $file = fopen($filePath, "w");
            fwrite($file, print_r($value, 1));
            #fclose();
            return;
        }
        public function translit($s){
            $s = (string)$s;
            $s = strip_tags($s);
            $s = str_replace(array("\n", "\r"), " ", $s);
            $s = preg_replace("/\s+/", ' ', $s);
            $s = trim($s);
            $s = function_exists('mb_strtolower') ? mb_strtolower($s) : strtolower($s);
            $s = strtr($s, array('а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd', 'е' => 'e', 'ё' => 'e', 'ж' => 'j', 'з' => 'z', 'и' => 'i', 'й' => 'y', 'к' => 'k', 'л' => 'l', 'м' => 'm', 'н' => 'n', 'о' => 'o', 'п' => 'p', 'р' => 'r', 'с' => 's', 'т' => 't', 'у' => 'u', 'ф' => 'f', 'х' => 'h', 'ц' => 'c', 'ч' => 'ch', 'ш' => 'sh', 'щ' => 'shch', 'ы' => 'y', 'э' => 'e', 'ю' => 'yu', 'я' => 'ya', 'ъ' => '', 'ь' => '', ' ' => '_'));
            $s = preg_replace("/[^0-9a-z-_ ]/i", "", $s);
            $s = str_replace(" ", "-", $s);
            return $s;
        }
        public function Decode($str) {
            $encode = mb_detect_encoding($str);
            if($encode == 'UTF-8') {
                $decode = $str;
            } else {
                $decode = iconv($encode, 'UTF-8', $str);
            }
            return $decode;
        }
        public function Log($data, $title = ''){
            define('DEBUG_FILE_NAME', date('Y-m-d').'.log');
            if(!DEBUG_FILE_NAME){ return false; }
            $log = "\n------------------------\n";
            $log .= date("Y.m.d G:i:s")."\n";
            #$log .= $this->GetUser()."\n";
            $log .= (strlen($title) > 0 ? $title : 'DEBUG')."\n";
            $log .= print_r($data, 1);
            $log .= "\n------------------------\n";
            #file_put_contents(__DIR__."/".DEBUG_FILE_NAME, $log, FILE_APPEND);
            file_put_contents($_SERVER["DOCUMENT_ROOT"]."/ils_log/".DEBUG_FILE_NAME, $log, FILE_APPEND);
            return;
        }
	}
?>