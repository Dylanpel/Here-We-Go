<?php
require_once(__DIR__ . "/../models/Participer.php");
require_once(__DIR__ . "/../models/ManagerParticiper.php");
require_once(__DIR__ . "/../models/Covoiturage.php");
require_once(__DIR__ . "/../models/ManagerCovoiturage.php");
require_once(__DIR__ . "/../models/ManagerNotification.php");

class ParticiperController {

    public function formurejoindreCovoit() {
        require_once("views/pages/form_rejoindre_covoit.php");
    }

    public function mesEvenements() {
        if(isset($_SESSION["user"])) {
            $evenements = ManagerParticiper::getEvenementsByUtilisateur($_SESSION["id"]);
            require_once("views/covoiturage/mes_evenements.php");
        } else {
            header('Location: ?controller=user&action=page_connexion');
            exit;
        }
    }

    public function ajouter() {
        $error = [];

        if(empty($_POST["quantite"])) {
            $error[] = "La quantité est obligatoire";
        }

        if(empty($error)) {
            if(ManagerParticiper::exists($_SESSION["id"], $_POST["id_covoiturage"])) {
                $error[] = "Tu as déjà rejoint ce covoiturage !";
            } else {
                $participer = new Participer([
                    'quantite'       => $_POST["quantite"],
                    'id_covoiturage' => $_POST["id_covoiturage"],
                    'id_utilisateur' => $_SESSION["id"],
                ]);

                $manager = new ManagerParticiper();
                $result = $manager->addParticiper($participer);

                if($result) {
                    $covoit = ManagerCovoiturage::get($_POST["id_covoiturage"]);
                    $id_createur = $covoit->getId_utilisateur();
                    ManagerNotification::add($id_createur, "🚗 " . $_SESSION["user"] . " a rejoint votre covoiturage !");

                    header('Location: ?controller=covoiturage&action=page_covoiturage');
                    exit;
                } else {
                    $error[] = "Erreur lors de l'enregistrement";
                }
            }
        }
    }

    public function validerDemande() {
        $id_utilisateur = $_GET["id_utilisateur"];
        $id_covoiturage = $_GET["id_covoiturage"];
        $statut         = $_GET["statut"];

        ManagerParticiper::updateStatut($id_utilisateur, $id_covoiturage, $statut);

        if($statut === 'accepte') {
            $message = "✅ Votre demande de covoiturage a été acceptée !";
        } else {
            $message = "❌ Votre demande de covoiturage a été refusée.";
        }

        ManagerNotification::add($id_utilisateur, $message);

        header('Location: ?controller=covoiturage&action=page_covoiturage');
        exit;
    }

    public function supprimerDemande() {
        ManagerParticiper::deleteDemande($_SESSION["id"], $_GET["id_covoiturage"]);
        header('Location: ?controller=covoiturage&action=page_covoiturage');
        exit;
    }
}