<?php
class ManagerRole {

    public static function all() {
        $db = Db::getInstance();
        $req = $db->query("SELECT * FROM role");
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function get($id) {
        $db = Db::getInstance();
        $req = $db->prepare("SELECT * FROM role WHERE id_role = :id");
        $req->execute(['id' => $id]);
        return $req->fetch(PDO::FETCH_ASSOC);
    }
}
?>