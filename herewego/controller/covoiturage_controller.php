<?php
require_once(__DIR__ . "/../models/Covoiturage.php");
require_once(__DIR__ . "/../models/ManagerCovoiturage.php");
require_once(__DIR__ . "/../models/Evenement.php");
require_once(__DIR__ . "/../models/ManagerEvenement.php");
require_once(__DIR__ . "/../models/Participer.php");
require_once(__DIR__ . "/../models/ManagerParticiper.php");

class CovoiturageController {

    public function insert() {
        if(isset($_SESSION["user"])) {
            $evenement = ManagerEvenement::getByUser($_SESSION["id"]);
            require_once("views/pages/form_ajouter_covoiturage.php");
        } else {
            header('Location: ?controller=user&action=page_connexion');
            exit;
        }
    }

    public function ajouter() {
        $error = [];

        if(empty($_POST["vehicule"])) {
            $error[] = "Le vehicule est obligatoire";
        }
        if(empty($_POST["description"])) {
            $error[] = "La description est obligatoire";
        }
        if(empty($_POST["nombre_place_dispo"])) {
            $error[] = "Il faut renseigner le nombre de places disponibles";
        }
        if(empty($_POST["montant"])) {
            $error[] = "Il faut renseigner le montant";
        }

        if(empty($error)) {
            $covoiturage = new Covoiturage([
                'vehicule'           => $_POST["vehicule"],
                'nombre_place_dispo' => $_POST["nombre_place_dispo"],
                'montant'            => $_POST["montant"],
                'description'        => $_POST["description"],
                'media_url_voiture'  => $_POST["media_url_voiture"],
                'id_evenement'       => $_POST["id_evenement"],
                'id_utilisateur'     => $_SESSION["id"],
            ]);

            $manager = new ManagerCovoiturage();
            $result = $manager->addCovoiturage($covoiturage);

            if($result) {
                header('Location: ?controller=covoiturage&action=page_covoiturage');
                exit;
            } else {
                $error[] = "Erreur lors de l'enregistrement";
            }
        }
    }

    public function list() {
        $covoiturage = ManagerCovoiturage::all();
        require_once("views/admin/list_covoiturage.php");
    }

    public function page_modification() {
        $covoiturage = ManagerCovoiturage::get($_GET["id"]);
        require_once("views/admin/modification_covoiturage.php");
    }

    public function update() {
        $up = new Covoiturage([
            "nombre_place_dispo" => $_POST["nombreplace"],
            "vehicule"           => $_POST["vehicule"],
            "montant"            => $_POST["montant"],
            "description"        => $_POST["description"],
            "media_url_voiture"  => $_POST["mediaUrlVoiture"],
            "id_utilisateur"     => $_POST["id_utilisateur"],
            "id_evenement"       => $_POST["id_evenement"],
            "id_covoiturage"     => $_POST["id"]
        ]);

        $manager = new ManagerCovoiturage();
        $manager->update($up);

        header('Location: ?controller=covoiturage&action=list');
        exit;
    }

    public function delete() {
        $covoiturage = new Covoiturage([
            "id_covoiturage" => $_GET["id"]
        ]);

        $manager = new ManagerCovoiturage();
        $manager->delete($covoiturage);

        header('Location: ?controller=covoiturage&action=list');
        exit;
    }

    public function page_covoiturage() {
        if(!isset($_SESSION["user"])) {
            header('Location: ?controller=user&action=page_connexion');
            exit;
        }

        $covoiturage = ManagerCovoiturage::getByCovoit($_SESSION["id"]);
        $covoiturages_rejoints = ManagerParticiper::getCovoituragesByUtilisateur($_SESSION["id"]);

        require_once("views/covoiturage/page_covoiturage.php");
    }
}