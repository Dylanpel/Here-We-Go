<?php
require_once("models/Evenement.php");

class ManagerEvenement {

    public static function all() {
        $list = [];
        $db = Db::getInstance();
        $req = $db->query("SELECT evenement.*, ville.nom_ville, utilisateur.pseudo 
            FROM evenement 
            INNER JOIN ville ON evenement.id_ville = ville.id_ville
            INNER JOIN utilisateur ON evenement.id_utilisateur = utilisateur.id_utilisateur
            ORDER BY date_debut_evenement DESC");
        foreach($req->fetchAll(PDO::FETCH_ASSOC) as $evenement) {
            $list[] = new Evenement($evenement);
        }
        return $list;
    }

    public static function findSearch($libelle, $date_debut = "", $date_fin = "", $departement = "") {
        $list = [];
        $db = Db::getInstance();
        $search = '%' . trim($libelle) . '%';

        $sql = "SELECT evenement.*, ville.*, categorie.libelle AS categorie
            FROM evenement 
            INNER JOIN ville ON evenement.id_ville = ville.id_ville
            INNER JOIN avoir_2 ON evenement.id_evenement = avoir_2.id_evenement
            INNER JOIN categorie ON avoir_2.id_categorie = categorie.id_categorie 
            WHERE (categorie.libelle LIKE :libelle  
            OR evenement.libelle LIKE :libelle
            OR ville.nom_ville LIKE :libelle)";

        $params = ["libelle" => $search];

        if(!empty($date_debut) && !empty($date_fin)) {
            $sql .= " AND evenement.date_debut_evenement BETWEEN :date_debut AND :date_fin";
            $params["date_debut"] = $date_debut;
            $params["date_fin"]   = $date_fin;
        } elseif(!empty($date_debut)) {
            $sql .= " AND evenement.date_debut_evenement >= :date_debut";
            $params["date_debut"] = $date_debut;
        } elseif(!empty($date_fin)) {
            $sql .= " AND evenement.date_debut_evenement <= :date_fin";
            $params["date_fin"] = $date_fin;
        }

        if(!empty($departement)) {
            $sql .= " AND ville.departement = :departement";
            $params["departement"] = $departement;
        }

        $sql .= " LIMIT 10";

        $req = $db->prepare($sql);
        $req->execute($params);
        foreach($req->fetchAll(PDO::FETCH_ASSOC) as $evenement) {
            $list[] = new Evenement($evenement);
        }
        return $list;
    }

    public static function findAllOrdered(string $libelle, int $limit = 4, int $offset = 0) {
        $list = [];
        $db = Db::getInstance();
        $stmt = $db->prepare("SELECT evenement.*, ville.* 
            FROM evenement 
            INNER JOIN ville ON evenement.id_ville = ville.id_ville
            INNER JOIN avoir_2 ON evenement.id_evenement = avoir_2.id_evenement
            INNER JOIN categorie ON avoir_2.id_categorie = categorie.id_categorie 
            WHERE categorie.libelle = :libelle
            LIMIT :limit OFFSET :offset");
        $stmt->bindValue(':libelle', $libelle, PDO::PARAM_STR);
        $stmt->bindValue(':limit',   $limit,   PDO::PARAM_INT);
        $stmt->bindValue(':offset',  $offset,  PDO::PARAM_INT);
        $stmt->execute();
        foreach($stmt->fetchAll(PDO::FETCH_ASSOC) as $evenement) {
            $list[] = new Evenement($evenement);
        }
        return $list;
    }

    public static function countByLibelle(string $libelle): int {
        $db = Db::getInstance();
        $stmt = $db->prepare("SELECT COUNT(*) AS total
            FROM evenement 
            INNER JOIN avoir_2 ON evenement.id_evenement = avoir_2.id_evenement
            INNER JOIN categorie ON avoir_2.id_categorie = categorie.id_categorie 
            WHERE categorie.libelle = :libelle");
        $stmt->bindValue(':libelle', $libelle, PDO::PARAM_STR);
        $stmt->execute();
        return (int) $stmt->fetch(PDO::FETCH_ASSOC)['total'];}

   public static function get($id) {
    $db = Db::getInstance();
    $id = intval($id);
    $get = $db->prepare("SELECT evenement.*, utilisateur.nom, utilisateur.pseudo, 
        utilisateur.prenom, ville.nom_ville, ville.code_postal, 
        ville.departement, categorie.id_categorie AS categorie,
        (SELECT COUNT(*) FROM participer_2 WHERE participer_2.id_evenement = evenement.id_evenement) AS nb_participants 
        FROM evenement
        INNER JOIN ville ON evenement.id_ville = ville.id_ville 
        INNER JOIN utilisateur ON evenement.id_utilisateur = utilisateur.id_utilisateur
        LEFT JOIN avoir_2 ON evenement.id_evenement = avoir_2.id_evenement
        LEFT JOIN categorie ON avoir_2.id_categorie = categorie.id_categorie 
        WHERE evenement.id_evenement = :id");
    $get->execute(['id' => $id]);
    $result = $get->fetch(PDO::FETCH_ASSOC);
    return new Evenement($result);
}

    public function addEvenement($obj, $id_categorie) {
        $db = Db::getInstance();
        $add = $db->prepare("INSERT INTO evenement (libelle, description,
            date_debut_evenement, date_fin_evenement, heure_evenement, 
            adresse, id_utilisateur, id_ville) 
            VALUES (:libelle, :description, :date_debut_evenement, :date_fin_evenement,
            :heure_evenement, :adresse, :id_utilisateur, :id_ville)");
        $add->execute([
            'libelle'              => $obj->getLibelle(),
            'description'          => $obj->getDescription(),
            'date_debut_evenement' => $obj->getDate_debut_evenement(),
            'date_fin_evenement'   => $obj->getDate_fin_evenement(),
            'heure_evenement'      => $obj->getHeure_evenement(),
            'adresse'              => $obj->getAdresse(),
            'id_utilisateur'       => $obj->getId_utilisateur(),
            'id_ville'             => $obj->getId_ville(),
        ]);
        $lastId = $db->lastInsertId();
        $db->prepare("INSERT INTO avoir_2 (id_evenement, id_categorie) VALUES (?, ?)")
           ->execute([$lastId, $id_categorie]);
        return $lastId;
    }

    public function delete() {
    $db = Db::getInstance();
    
   
    $db->prepare("DELETE FROM participer WHERE id_covoiturage IN (SELECT id_covoiturage FROM covoiturage WHERE id_evenement = :id)")
       ->execute(['id' => $_GET["id"]]);

    $db->prepare("DELETE FROM avoir_2 WHERE id_evenement = :id")
       ->execute(['id' => $_GET["id"]]);

    $db->prepare("DELETE FROM covoiturage WHERE id_evenement = :id")
       ->execute(['id' => $_GET["id"]]);

    $db->prepare("DELETE FROM media WHERE id_evenement = :id")
       ->execute(['id' => $_GET["id"]]);

    $db->prepare("DELETE FROM participer_2 WHERE id_evenement = :id")
       ->execute(['id' => $_GET["id"]]);
    
   
    $db->prepare("DELETE FROM evenement WHERE id_evenement = :id")
       ->execute(['id' => $_GET["id"]]);
}

    public function update($obj, $id_categorie = null) {
    $db = Db::getInstance();
    
   
    $update = $db->prepare("UPDATE evenement SET libelle = :libelle, description = :description, 
        date_debut_evenement = :date_debut_evenement, date_fin_evenement = :date_fin_evenement, 
        heure_evenement = :heure_evenement, adresse = :adresse, id_ville = :id_ville  
        WHERE id_evenement = :id_evenement");
    $result = $update->execute([
        'libelle'              => $obj->getLibelle(),
        'description'          => $obj->getDescription(),
        'date_debut_evenement' => $obj->getDate_debut_evenement(),
        'date_fin_evenement'   => $obj->getDate_fin_evenement(),
        'heure_evenement'      => $obj->getHeure_evenement(),
        'adresse'              => $obj->getAdresse(),
        'id_ville'             => $obj->getId_ville(),
        'id_evenement'         => $obj->getId_evenement(),
    ]);

  
    if($id_categorie) {
    $stmt = $db->prepare("INSERT INTO avoir_2 (id_evenement, id_categorie) 
        VALUES (:id_evenement, :id_categorie)
        ON DUPLICATE KEY UPDATE id_categorie = :id_categorie");
    $stmt->execute([
        'id_categorie' => $id_categorie,
        'id_evenement' => $obj->getId_evenement()
    ]);
    }

    return $result;
}
    public function participerEvenement($obj) {
        $db = Db::getInstance();
        $update = $db->prepare("INSERT INTO participer_2 (id_evenement, id_utilisateur)
            VALUES (:id_evenement, :id_utilisateur)");
        return $update->execute([
            'id_evenement'   => $obj->getId_evenement(),
            'id_utilisateur' => $obj->getId_utilisateur(),
        ]);
    }

    public static function getByUser($id_user) {
        $list = [];
        $db = Db::getInstance();
        $req = $db->prepare("SELECT evenement.*
            FROM evenement
            INNER JOIN participer_2 ON participer_2.id_evenement = evenement.id_evenement
            WHERE participer_2.id_utilisateur = :id_user
            ORDER BY evenement.date_debut_evenement DESC");
        $req->execute(['id_user' => $id_user]);
        foreach($req->fetchAll(PDO::FETCH_ASSOC) as $evenement) {
            $list[] = new Evenement($evenement);
        }
        return $list;
    }

    public static function findByDepartement($departement) {
        $list = [];
        $db = Db::getInstance();
        $req = $db->prepare("SELECT evenement.*, ville.nom_ville, ville.departement, utilisateur.pseudo
            FROM evenement
            INNER JOIN ville ON evenement.id_ville = ville.id_ville
            INNER JOIN utilisateur ON evenement.id_utilisateur = utilisateur.id_utilisateur
            WHERE ville.departement = :departement
            ORDER BY evenement.date_debut_evenement ASC");
        $req->execute(['departement' => $departement]);
        foreach($req->fetchAll(PDO::FETCH_ASSOC) as $evenement) {
            $list[] = new Evenement($evenement);
        }
        return $list;
    }
}
?>