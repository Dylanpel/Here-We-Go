<?php
class ManagerParticiper {

    public static function all() {
        $list = [];
        $db = Db::getInstance();
        $req = $db->query("SELECT participer.id_utilisateur, participer.id_covoiturage, utilisateur.pseudo
            FROM participer
            INNER JOIN covoiturage ON covoiturage.id_covoiturage = participer.id_covoiturage
            INNER JOIN utilisateur ON utilisateur.id_utilisateur = participer.id_utilisateur");
        foreach($req->fetchAll(PDO::FETCH_ASSOC) as $participer) {
            $list[] = new Participer($participer);
        }
        return $list;
    }

    public static function get($id) {
        $db = Db::getInstance();
        $id = intval($id);
        $get = $db->prepare("SELECT participer.id_utilisateur, participer.id_covoiturage, utilisateur.pseudo
            FROM participer
            INNER JOIN covoiturage ON covoiturage.id_covoiturage = participer.id_covoiturage
            INNER JOIN utilisateur ON utilisateur.id_utilisateur = participer.id_utilisateur
            WHERE utilisateur.id_utilisateur = :id");
        $get->execute(['id' => $id]);
        $result = $get->fetch(PDO::FETCH_ASSOC);
        return new Participer($result);
    }

    public static function getEvenementsByUtilisateur($id_utilisateur) {
        $db = Db::getInstance();
        $req = $db->prepare("SELECT evenement.libelle, evenement.id_evenement,
               covoiturage.id_covoiturage, covoiturage.vehicule, 
               covoiturage.nombre_place_dispo, covoiturage.montant,
               covoiturage.id_utilisateur,
               utilisateur.pseudo,
               (covoiturage.nombre_place_dispo -
                COALESCE(SUM(CASE WHEN p.statut != 'refuse' THEN p.quantite ELSE 0 END), 0)) AS places_restantes
            FROM participer_2
            INNER JOIN evenement ON evenement.id_evenement = participer_2.id_evenement
            LEFT JOIN covoiturage ON covoiturage.id_evenement = evenement.id_evenement
            LEFT JOIN utilisateur ON utilisateur.id_utilisateur = covoiturage.id_utilisateur
            LEFT JOIN participer p ON p.id_covoiturage = covoiturage.id_covoiturage
            WHERE participer_2.id_utilisateur = :id_utilisateur
            GROUP BY covoiturage.id_covoiturage, evenement.id_evenement, covoiturage.id_utilisateur");
        $req->execute(['id_utilisateur' => $id_utilisateur]);
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getCovoituragesByUtilisateur($id_utilisateur) {
        $db = Db::getInstance();
        $req = $db->prepare("SELECT covoiturage.id_covoiturage, covoiturage.vehicule, 
                covoiturage.nombre_place_dispo, covoiturage.montant,
                evenement.libelle, part.quantite, part.statut,
                (covoiturage.nombre_place_dispo - 
                COALESCE(SUM(CASE WHEN tous.statut != 'refuse' THEN tous.quantite ELSE 0 END), 0)) AS places_restantes
            FROM participer part
            INNER JOIN covoiturage ON covoiturage.id_covoiturage = part.id_covoiturage
            INNER JOIN evenement ON evenement.id_evenement = covoiturage.id_evenement
            LEFT JOIN participer tous ON tous.id_covoiturage = covoiturage.id_covoiturage
            WHERE part.id_utilisateur = :id_utilisateur
            GROUP BY covoiturage.id_covoiturage, part.quantite, part.statut");
        $req->execute(['id_utilisateur' => $id_utilisateur]);
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function exists($id_utilisateur, $id_covoiturage) {
        $db = Db::getInstance();
        $req = $db->prepare("SELECT COUNT(*) FROM participer 
            WHERE id_utilisateur = :id_utilisateur 
            AND id_covoiturage = :id_covoiturage
            AND statut != 'refuse'");
        $req->execute([
            'id_utilisateur' => $id_utilisateur,
            'id_covoiturage' => $id_covoiturage,
        ]);
        return $req->fetchColumn() > 0;
    }

    public static function updateStatut($id_utilisateur, $id_covoiturage, $statut) {
        $db = Db::getInstance();
        $req = $db->prepare("UPDATE participer SET statut = :statut 
            WHERE id_utilisateur = :id_utilisateur AND id_covoiturage = :id_covoiturage");
        return $req->execute([
            'statut'         => $statut,
            'id_utilisateur' => $id_utilisateur,
            'id_covoiturage' => $id_covoiturage,
        ]);
    }

    public static function getDemandesByCovoiturage($id_covoiturage) {
        $db = Db::getInstance();
        $req = $db->prepare("SELECT participer.*, utilisateur.pseudo
            FROM participer
            INNER JOIN utilisateur ON utilisateur.id_utilisateur = participer.id_utilisateur
            WHERE participer.id_covoiturage = :id_covoiturage 
            AND participer.statut = 'en_attente'");
        $req->execute(['id_covoiturage' => $id_covoiturage]);
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function deleteDemande($id_utilisateur, $id_covoiturage) {
        $db = Db::getInstance();
        $req = $db->prepare("DELETE FROM participer 
            WHERE id_utilisateur = :id_utilisateur 
            AND id_covoiturage = :id_covoiturage
            AND statut = 'refuse'");
        return $req->execute([
            'id_utilisateur' => $id_utilisateur,
            'id_covoiturage' => $id_covoiturage,
        ]);
    }

    public static function getParticipantsByCovoiturage($id_covoiturage) {
        $db = Db::getInstance();
        $req = $db->prepare("SELECT utilisateur.id_utilisateur, utilisateur.pseudo, 
                participer.quantite, participer.statut
            FROM participer
            INNER JOIN utilisateur ON utilisateur.id_utilisateur = participer.id_utilisateur
            WHERE participer.id_covoiturage = :id_covoiturage
            AND participer.statut = 'accepte'");
        $req->execute(['id_covoiturage' => $id_covoiturage]);
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addParticiper($obj) {
        $db = Db::getInstance();
        $check = $db->prepare("SELECT COUNT(*) FROM participer 
            WHERE id_utilisateur = :id_utilisateur 
            AND id_covoiturage = :id_covoiturage 
            AND statut = 'refuse'");
        $check->execute([
            'id_utilisateur' => $obj->getId_utilisateur(),
            'id_covoiturage' => $obj->getId_covoiturage(),
        ]);

        if($check->fetchColumn() > 0) {
            $update = $db->prepare("UPDATE participer SET quantite = :quantite, statut = 'en_attente' 
                WHERE id_utilisateur = :id_utilisateur AND id_covoiturage = :id_covoiturage");
            return $update->execute([
                'quantite'       => $obj->getQuantite(),
                'id_utilisateur' => $obj->getId_utilisateur(),
                'id_covoiturage' => $obj->getId_covoiturage(),
            ]);
        } else {
            $add = $db->prepare("INSERT INTO participer (quantite, id_utilisateur, id_covoiturage) 
                VALUES (:quantite, :id_utilisateur, :id_covoiturage)");
            return $add->execute([
                'quantite'       => $obj->getQuantite(),
                'id_utilisateur' => $obj->getId_utilisateur(),
                'id_covoiturage' => $obj->getId_covoiturage(),
            ]);
        }
    }
}
?>