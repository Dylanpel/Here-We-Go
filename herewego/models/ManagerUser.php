<?php
class ManagerUser {

    public static function all($id) {
        $list = [];
        $db = Db::getInstance();
        $req = $db->prepare("SELECT * FROM utilisateur WHERE id_utilisateur = :id");
        $req->execute(['id' => $id]);
        foreach($req->fetchAll(PDO::FETCH_ASSOC) as $utilisateur) {
            $list[] = new Utilisateur($utilisateur);
        }
        return $list;
    }

    public static function listUser() {
        $list = [];
        $db = Db::getInstance();
        $req = $db->query("SELECT * FROM utilisateur ORDER BY pseudo ASC");
        foreach($req->fetchAll(PDO::FETCH_ASSOC) as $utilisateur) {
            $list[] = new Utilisateur($utilisateur);
        }
        return $list;
    }

    public static function get($id) {
        $db = Db::getInstance();
        $id = intval($id);
        $get = $db->prepare("SELECT evenement.*, utilisateur.nom, 
            utilisateur.prenom, ville.nom_ville, ville.code_postal, 
            ville.departement, categorie.libelle AS categorie 
            FROM evenement
            INNER JOIN ville ON evenement.id_ville = ville.id_ville 
            INNER JOIN utilisateur ON evenement.id_utilisateur = utilisateur.id_utilisateur
            INNER JOIN avoir_2 ON evenement.id_evenement = avoir_2.id_evenement
            INNER JOIN categorie ON avoir_2.id_categorie = categorie.id_categorie 
            WHERE evenement.id_utilisateur = :id");
        $get->execute(['id' => $id]);
        $evenement = [];
        foreach($get->fetchAll(PDO::FETCH_ASSOC) as $info) {
            $evenement[] = new Evenement($info);
        }
        return $evenement;
    }

    public static function getById($id) {
        $db = Db::getInstance();
        $req = $db->prepare("SELECT utilisateur.*, ville.nom_ville, ville.code_postal, ville.departement 
            FROM utilisateur 
            LEFT JOIN ville ON utilisateur.id_ville = ville.id_ville
            WHERE utilisateur.id_utilisateur = :id");
        $req->execute(['id' => $id]);
        $result = $req->fetch(PDO::FETCH_ASSOC);
        return new Utilisateur($result);
    }

    public function add($obj) {
        $db = Db::getInstance();
        $req = $db->prepare("INSERT INTO utilisateur (email, password, pseudo, nom, prenom, 
            date_de_naissance, adresse, numeros_telephone, id_ville, id_role, verouille, statut) 
            VALUES (:email, :password, :pseudo, :nom, :prenom, :date_de_naissance, :adresse, 
            :numeros_telephone, :id_ville, :id_role, :verouille, :statut)");
        return $req->execute([
            'email'             => $obj->getEmail(),
            'password'          => $obj->getPassword(),
            'pseudo'            => $obj->getPseudo(),
            'nom'               => $obj->getNom(),
            'prenom'            => $obj->getPrenom(),
            'date_de_naissance' => $obj->getDate_de_naissance(),
            'adresse'           => $obj->getAdresse(),
            'numeros_telephone' => $obj->getNumeros_telephone(),
            'id_ville'          => $obj->getId_ville(),
            'id_role'           => $obj->getId_role(),
            'verouille'         => $obj->getVerouille(),
            'statut'            => 'en_attente',
        ]);
    }

    public function connexion($email) {
        $db = Db::getInstance();
        $req = $db->prepare("SELECT utilisateur.id_utilisateur, utilisateur.email, 
            utilisateur.password, utilisateur.statut, utilisateur.nom, role.libelle AS role 
            FROM utilisateur 
            INNER JOIN role ON utilisateur.id_role = role.id_role 
            WHERE email = :email");
        $req->execute(['email' => $email]);
        $info = $req->fetch(PDO::FETCH_ASSOC);
        return new Utilisateur($info);
    }

    public function GetUserByEmail($email) {
        $db = Db::getInstance();
        $req = $db->prepare("SELECT utilisateur.id_utilisateur, utilisateur.email, 
            utilisateur.nom, role.libelle 
            FROM utilisateur 
            INNER JOIN role ON utilisateur.id_role = role.id_role 
            WHERE email = :email");
        $req->execute(['email' => $email]);
        $info = $req->fetch(PDO::FETCH_ASSOC);
        if($info) {
            return new Utilisateur($info);
        }
    }

    public function updateCompteur($id) {
        $db = Db::getInstance();
        $req = $db->prepare("UPDATE utilisateur SET compteur_evenement = compteur_evenement + 1 
            WHERE id_utilisateur = :id");
        $req->execute(['id' => $id]);
    }

    public static function getCompteur($id) {
        $db = Db::getInstance();
        $get = $db->prepare("SELECT compteur_evenement FROM utilisateur WHERE id_utilisateur = :id");
        $get->execute(['id' => $id]);
        return $get->fetch(PDO::FETCH_ASSOC);
    }

    public static function getCategorieUser($id) {
        $db = Db::getInstance();
        $req = $db->prepare("SELECT avoir_2.id_categorie, categorie.libelle, COUNT(*) AS nb_participations
            FROM participer_2
            INNER JOIN avoir_2 ON participer_2.id_evenement = avoir_2.id_evenement
            INNER JOIN categorie ON avoir_2.id_categorie = categorie.id_categorie
            WHERE participer_2.id_utilisateur = :id
            GROUP BY avoir_2.id_categorie, categorie.libelle
            ORDER BY nb_participations DESC");
        $req->execute(['id' => $id]);
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getEvenementsRecommandes($id) {
        $db = Db::getInstance();
        $categories = self::getCategorieUser($id);
        $req = $db->prepare("SELECT evenement.* 
            FROM evenement
            INNER JOIN avoir_2 ON evenement.id_evenement = avoir_2.id_evenement
            WHERE avoir_2.id_categorie = :id_categorie
            LIMIT 5");
        $req->execute(['id_categorie' => $categories[0]["id_categorie"]]);
        $evenements = [];
        foreach($req->fetchAll(PDO::FETCH_ASSOC) as $row) {
            $evenements[] = new Evenement($row);
        }
        return $evenements;
    }

    public static function getEnAttente() {
        $db = Db::getInstance();
        $req = $db->query("SELECT * FROM utilisateur WHERE statut = 'en_attente'");
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function validerCompte($id_utilisateur, $statut) {
        $db = Db::getInstance();
        $req = $db->prepare("UPDATE utilisateur SET statut = :statut WHERE id_utilisateur = :id_utilisateur");
        return $req->execute([
            'statut'         => $statut,
            'id_utilisateur' => $id_utilisateur,
        ]);
    }

    public function delete() {
        $db = Db::getInstance();
        $id = $_GET["id"];

        $db->prepare("DELETE FROM notification WHERE id_utilisateur = :id")->execute(['id' => $id]);
        $db->prepare("DELETE FROM participer WHERE id_utilisateur = :id")->execute(['id' => $id]);
        $db->prepare("DELETE FROM participer_2 WHERE id_utilisateur = :id")->execute(['id' => $id]);

        $covoiturages = $db->prepare("SELECT id_covoiturage FROM covoiturage WHERE id_utilisateur = :id");
        $covoiturages->execute(['id' => $id]);
        foreach($covoiturages->fetchAll(PDO::FETCH_ASSOC) as $covoit) {
            $db->prepare("DELETE FROM participer WHERE id_covoiturage = :id_covoiturage")
               ->execute(['id_covoiturage' => $covoit['id_covoiturage']]);
        }

        $db->prepare("DELETE FROM covoiturage WHERE id_utilisateur = :id")->execute(['id' => $id]);
        $db->prepare("DELETE FROM avoir_2 WHERE id_evenement IN (SELECT id_evenement FROM evenement WHERE id_utilisateur = :id)")->execute(['id' => $id]);
        $db->prepare("DELETE FROM evenement WHERE id_utilisateur = :id")->execute(['id' => $id]);
        $db->prepare("DELETE FROM utilisateur WHERE id_utilisateur = :id")->execute(['id' => $id]);
    }

    public function update($obj) {
        $db = Db::getInstance();

        if($obj->getPassword()) {
            $req = $db->prepare("UPDATE utilisateur SET email=:email, pseudo=:pseudo, nom=:nom, 
                prenom=:prenom, date_de_naissance=:date_de_naissance, adresse=:adresse, 
                numeros_telephone=:numeros_telephone, id_role=:id_role, statut=:statut,
                id_ville=:id_ville, password=:password
                WHERE id_utilisateur=:id_utilisateur");
            return $req->execute([
                'email'             => $obj->getEmail(),
                'pseudo'            => $obj->getPseudo(),
                'nom'               => $obj->getNom(),
                'prenom'            => $obj->getPrenom(),
                'date_de_naissance' => $obj->getDate_de_naissance(),
                'adresse'           => $obj->getAdresse(),
                'numeros_telephone' => $obj->getNumeros_telephone(),
                'id_role'           => $obj->getId_role(),
                'statut'            => $obj->getStatut(),
                'id_ville'          => $obj->getId_ville(),
                'password'          => $obj->getPassword(),
                'id_utilisateur'    => $obj->getId_utilisateur(),
            ]);
        } else {
            $req = $db->prepare("UPDATE utilisateur SET email=:email, pseudo=:pseudo, nom=:nom, 
                prenom=:prenom, date_de_naissance=:date_de_naissance, adresse=:adresse, 
                numeros_telephone=:numeros_telephone, id_role=:id_role, statut=:statut,
                id_ville=:id_ville
                WHERE id_utilisateur=:id_utilisateur");
            return $req->execute([
                'email'             => $obj->getEmail(),
                'pseudo'            => $obj->getPseudo(),
                'nom'               => $obj->getNom(),
                'prenom'            => $obj->getPrenom(),
                'date_de_naissance' => $obj->getDate_de_naissance(),
                'adresse'           => $obj->getAdresse(),
                'numeros_telephone' => $obj->getNumeros_telephone(),
                'id_role'           => $obj->getId_role(),
                'statut'            => $obj->getStatut(),
                'id_ville'          => $obj->getId_ville(),
                'id_utilisateur'    => $obj->getId_utilisateur(),
            ]);
        }
    }
}
?>