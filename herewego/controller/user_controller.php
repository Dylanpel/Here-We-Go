<?php
require_once(__DIR__ . "/../models/Utilisateur.php");
require_once(__DIR__ . "/../models/ManagerUser.php");

class UserController {

    public function page_inscription() {
        require_once("views/user/inscription_user.php");
    }

    public function inscrire() {
        $user = new Utilisateur([
            'email'             => $_POST["email"],
            'password'          => password_hash($_POST["password"], PASSWORD_DEFAULT),
            'nom'               => $_POST["nom"],
            'prenom'            => $_POST["prenom"],
            'pseudo'            => $_POST["pseudo"],
            'date_de_naissance' => $_POST["date_naissance"],
            'adresse'           => $_POST["adresse"],
            'numeros_telephone' => $_POST["numeros_telephone"],
            'id_ville'          => $_POST["id_ville"],
            'id_role'           => $_POST["id_role"],
            'verouille'         => $_POST["verouille"],
            'statut'            => 'en_attente',
        ]);

        $manager = new ManagerUser();
        $result = $manager->add($user);

        if($result) {
            $_SESSION['inscription_message'] = "Votre compte est en attente de validation par un administrateur.";
            header('Location: ?controller=user&action=page_connexion');
            exit;
        } else {
            echo "Erreur lors de l'inscription";
        }
    }

    public function page_connexion() {
        require_once("views/user/connection.php");
    }

    public function connection() {
        $manager = new ManagerUser();
        $user = $manager->connexion($_POST["email"]);

        try {
            if(!$user) {
                throw new Exception("Utilisateur introuvable");
            }
            if(!password_verify($_POST["password"], $user->getPassword())) {
                throw new Exception("Votre mot de passe est incorrect");
            }
            if($user->getStatut() == 'en_attente') {
                throw new Exception("Votre compte est en attente de validation par un administrateur.");
            }
            if($user->getStatut() == 'refuse') {
                throw new Exception("Votre compte a été refusé. Contactez un administrateur.");
            }

            $_SESSION["user"] = $user->getNom();
            $_SESSION["id"]   = $user->getId_utilisateur();
            $_SESSION["role"] = $user->getRole();

            header('Location: http://localhost/git/Projet-Fil-rouge-Here-We-GO/herewego/');
            exit;

        } catch(Exception $e) {
            echo $e->getMessage();
        }
    }

    public function deconecter() {
        session_destroy();
        header('Location: http://localhost/git/Projet-Fil-rouge-Here-We-GO/herewego/');
        exit;
    }

    public function list() {
        $utilisateur = ManagerUser::listUser();
        require_once("views/user/list.php");
    }

    public function delete() {
        $utilisateur = new Utilisateur([
            "id_utilisateur" => $_GET["id"]
        ]);
        $manager = new ManagerUser();
        $manager->delete($utilisateur);

        header('Location: ?controller=user&action=list');
        exit;
    }

    public function page_modification() {
        $utilisateur = ManagerUser::getById($_GET["id"]);
        require_once("views/admin/modification_user.php");
    }

    public function update() {
        $data = [
            "id_utilisateur"    => $_POST["id_utilisateur"],
            "email"             => $_POST["email"],
            "pseudo"            => $_POST["pseudo"],
            "nom"               => $_POST["nom"],
            "prenom"            => $_POST["prenom"],
            "date_de_naissance" => $_POST["date_de_naissance"],
            "adresse"           => $_POST["adresse"],
            "numeros_telephone" => $_POST["numeros_telephone"],
            "id_role"           => $_POST["id_role"],
            "statut"            => $_POST["statut"],
            "id_ville"          => $_POST["id_ville"],
        ];

        if(!empty($_POST["password"]) && $_POST["password"] === $_POST["password_confirm"]) {
            $data["password"] = password_hash($_POST["password"], PASSWORD_DEFAULT);
        }

        $up = new Utilisateur($data);
        $manager = new ManagerUser();
        $manager->update($up);

        header('Location: ?controller=pages&action=profil&id=' . $_POST["id_utilisateur"]);
        exit;
    }
}