<?php
class ManagerParticipant {

    public static function all() {
        $list = [];
        $db = Db::getInstance();
        $req = $db->query("SELECT participer_2.id_utilisateur, participer_2.id_evenement, 
            utilisateur.pseudo, evenement.libelle
            FROM participer_2
            INNER JOIN evenement ON evenement.id_evenement = participer_2.id_evenement
            INNER JOIN utilisateur ON utilisateur.id_utilisateur = participer_2.id_utilisateur");
        foreach($req->fetchAll(PDO::FETCH_ASSOC) as $evenement) {
            $list[] = new Evenement($evenement);
        }
        return $list;
    }

    public function participerEvenement($id_evenement, $id_utilisateur) {
        $db = Db::getInstance();
        $update = $db->prepare("INSERT INTO participer_2 (id_evenement, id_utilisateur)
            VALUES (:id_evenement, :id_utilisateur)");
        return $update->execute([
            'id_evenement'   => $id_evenement,
            'id_utilisateur' => $id_utilisateur,
        ]);
    }

    public static function getCovoituragesByUtilisateur($id_utilisateur) {
        $db = Db::getInstance();
        $req = $db->prepare("SELECT covoiturage.id_covoiturage, covoiturage.vehicule, 
               covoiturage.nombre_place_dispo, covoiturage.montant,
               evenement.libelle, participer.quantite,
               (covoiturage.nombre_place_dispo - COALESCE(SUM(p.quantite), 0)) AS places_restantes
            FROM participer
            INNER JOIN covoiturage ON covoiturage.id_covoiturage = participer.id_covoiturage
            INNER JOIN evenement ON evenement.id_evenement = covoiturage.id_evenement
            LEFT JOIN participer p ON p.id_covoiturage = covoiturage.id_covoiturage
            WHERE participer.id_utilisateur = :id_utilisateur
            AND participer.statut = 'accepte'
            GROUP BY covoiturage.id_covoiturage");
        $req->execute(['id_utilisateur' => $id_utilisateur]);
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getById($id) {
        $list = [];
        $db = Db::getInstance();
        $get = $db->prepare("SELECT participer_2.id_evenement, participer_2.id_utilisateur, 
            evenement.*, utilisateur.id_utilisateur, ville.nom_ville 
            FROM participer_2 
            INNER JOIN evenement ON evenement.id_evenement = participer_2.id_evenement
            INNER JOIN ville ON evenement.id_ville = ville.id_ville
            INNER JOIN utilisateur ON utilisateur.id_utilisateur = participer_2.id_utilisateur
            WHERE utilisateur.id_utilisateur = :id");
        $get->execute(['id' => $id]);
        foreach($get->fetchAll(PDO::FETCH_ASSOC) as $evenement) {
            $list[] = new Evenement($evenement);
        }
        return $list;
    }
}
?>