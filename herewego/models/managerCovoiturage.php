<?php
class ManagerCovoiturage {

    public static function all() {
        $list = [];
        $db = Db::getInstance();
        $req = $db->query("SELECT covoiturage.*, utilisateur.pseudo, 
            evenement.libelle, evenement.date_debut_evenement, evenement.adresse,
            ville.nom_ville
            FROM covoiturage 
            INNER JOIN utilisateur ON covoiturage.id_utilisateur = utilisateur.id_utilisateur
            INNER JOIN evenement ON covoiturage.id_evenement = evenement.id_evenement
            INNER JOIN ville ON evenement.id_ville = ville.id_ville
        ");
        foreach($req->fetchAll(PDO::FETCH_ASSOC) as $covoiturage) {
            $list[] = new Covoiturage($covoiturage);
        }
        return $list;
    }

    public static function get($id) {
        $db = Db::getInstance();
        $id = intval($id);
        $get = $db->prepare("SELECT * FROM covoiturage WHERE id_covoiturage = :id");
        $get->execute(['id' => $id]);
        $result = $get->fetch(PDO::FETCH_ASSOC);
        return new Covoiturage($result);
    }

    public static function getEvenement($id) {
        $db = Db::getInstance();
        $id = intval($id);
        $get = $db->prepare("SELECT id_evenement FROM covoiturage WHERE id_evenement = :id");
        $get->execute(['id' => $id]);
        $result = $get->fetch(PDO::FETCH_ASSOC);
        return new Covoiturage($result);
    }

    public function delete() {
        $db = Db::getInstance();
        $id = $_GET["id"];
        $db->prepare("DELETE FROM participer WHERE id_covoiturage = :id")->execute(['id' => $id]);
        $db->prepare("DELETE FROM covoiturage WHERE id_covoiturage = :id")->execute(['id' => $id]);
    }

    public function addCovoiturage($obj) {
        $db = Db::getInstance();
        $add = $db->prepare("INSERT INTO covoiturage (nombre_place_dispo, vehicule, montant,
            description, media_url_voiture, id_utilisateur, id_evenement) 
            VALUES (:nombre_place_dispo, :vehicule, :montant, :description, 
            :media_url_voiture, :id_utilisateur, :id_evenement)");
        return $add->execute([
            'nombre_place_dispo' => $obj->getNombre_place_dispo(),
            'vehicule'           => $obj->getVehicule(),
            'montant'            => $obj->getMontant(),
            'description'        => $obj->getDescription(),
            'media_url_voiture'  => $obj->getMedia_url_voiture(),
            'id_utilisateur'     => $obj->getId_utilisateur(),
            'id_evenement'       => $obj->getId_evenement(),
        ]);
    }

    public function update($obj) {
        $db = Db::getInstance();
        $update = $db->prepare("UPDATE covoiturage 
            SET nombre_place_dispo = :nombre_place_dispo, vehicule = :vehicule, montant = :montant, 
            description = :description, media_url_voiture = :media_url_voiture, 
            id_utilisateur = :id_utilisateur, id_evenement = :id_evenement
            WHERE id_covoiturage = :id_covoiturage");
        return $update->execute([
            'nombre_place_dispo' => $obj->getNombre_place_dispo(),
            'vehicule'           => $obj->getVehicule(),
            'montant'            => $obj->getMontant(),
            'description'        => $obj->getDescription(),
            'media_url_voiture'  => $obj->getMedia_url_voiture(),
            'id_utilisateur'     => $obj->getId_utilisateur(),
            'id_evenement'       => $obj->getId_evenement(),
            'id_covoiturage'     => $obj->getId_covoiturage(),
        ]);
    }

    public static function getByCovoit($id_utilisateur) {
        $list = [];
        $db = Db::getInstance();
        $req = $db->prepare("SELECT covoiturage.*, evenement.libelle,
                (covoiturage.nombre_place_dispo - COALESCE(SUM(CASE WHEN p.statut != 'refuse' THEN p.quantite ELSE 0 END), 0)) AS placesrestantes
            FROM covoiturage
            INNER JOIN evenement ON covoiturage.id_evenement = evenement.id_evenement
            LEFT JOIN participer p ON p.id_covoiturage = covoiturage.id_covoiturage
            WHERE covoiturage.id_utilisateur = :id_utilisateur
            GROUP BY covoiturage.id_covoiturage
        ");
        $req->execute(['id_utilisateur' => $id_utilisateur]);
        foreach($req->fetchAll(PDO::FETCH_ASSOC) as $data) {
            $list[] = new Covoiturage($data);
        }
        return $list;
    }
}
?>