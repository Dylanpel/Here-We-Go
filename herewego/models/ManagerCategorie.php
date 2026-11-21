<?php
class ManagerCategorie {

    public static function all() {
        $list = [];
        $db = Db::getInstance();
        $req = $db->prepare("SELECT * FROM categorie");
        $req->execute();
        foreach($req->fetchAll(PDO::FETCH_ASSOC) as $categorie) {
            $list[] = $categorie;
        }
        return $list;
    }

    public static function get($id) {
        $db = Db::getInstance();
        $id = intval($id);
        $get = $db->prepare("SELECT avoir_2.id_evenement, avoir_2.id_categorie, 
                categorie.libelle, evenement.libelle
            FROM avoir_2
            INNER JOIN evenement ON evenement.id_evenement = avoir_2.id_evenement
            INNER JOIN categorie ON categorie.id_categorie = avoir_2.id_categorie
            WHERE evenement.id_evenement = :id");
        $get->execute(['id' => $id]);
        $result = $get->fetch(PDO::FETCH_ASSOC);
        return new Categorie($result);
    }

    public static function add($obj) {
        $db = Db::getInstance();
        $add = $db->prepare("INSERT INTO categorie (libelle, id_categorie) 
            VALUES (:libelle, :id_categorie)");
        return $add->execute([
            'libelle'      => $obj->getLibelle(),
            'id_categorie' => $obj->getId_categorie(),
        ]);
    }

    public static function update($obj) {
        $db = Db::getInstance();
        $up = $db->prepare("UPDATE categorie SET libelle = :libelle 
            WHERE id_categorie = :id_categorie");
        return $up->execute([
            'libelle'      => $obj->getLibelle(),
            'id_categorie' => $obj->getId_categorie(),
        ]);
    }

    public static function delete($id) {
        $db = Db::getInstance();
        $delete = $db->prepare("DELETE FROM categorie WHERE id_categorie = :id");
        return $delete->execute(['id' => $id]);
    }
}
?>