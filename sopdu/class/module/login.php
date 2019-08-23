<?php
require_once ($_SERVER["DOCUMENT_ROOT"].'/sopdu/class/ilsMain.php');
class ilsLogin {
    public function See($login, $password){
        $zapros = ilsDB::connect()->query("
            select id from user where name = '".$login."' and pass = '".md5($password)."'
        ");
        return $zapros->fetch(PDO::FETCH_ASSOC);
    }
    private function getSid(){
        return md5($_SERVER["HTTP_USER_AGENT"].$_SERVER["HTTP_ACCEPT"].$_SERVER["REMOTE_ADDR"]);
    }
    public function seeSid(){
        $zapros = ilsDB::connect()->prepare("select sid from sid where sid= :sidcode");
        $zapros->execute(array('sidcode' => self::getSid()));
        if($zapros->fetch(PDO::FETCH_ASSOC)){
            return 'Y';
        } else {
            return 'N';
        }
    }
    public function addSid($user_id){
        ilsDB::connect()->query("
            insert into sid (sid, user_id) values ('".self::getSid()."', '".$user_id."')
        ");
        return;
    }
    public function dropSid(){
        $zapros = ilsDB::connect()->prepare("delete from sid where sid= :sidcode");
        $zapros->execute(array('sidcode' =>  self::getSid()));
        return;
    }
}
?>