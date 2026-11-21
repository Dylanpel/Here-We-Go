<?php
require_once(__DIR__ . "/../models/Evenement.php");
require_once(__DIR__ . "/../models/ManagerEvenement.php");
require_once(__DIR__ . "/../models/ManagerUser.php");
require_once(__DIR__ . "/../models/Utilisateur.php");
require_once(__DIR__ . "/../models/Participant.php");
require_once(__DIR__ . "/../models/ManagerParticipant.php");
require_once(__DIR__ . "/../models/Covoiturage.php");
require_once(__DIR__ . "/../models/ManagerCovoiturage.php");

class PagesController {

    public function home() {
        $evenement = array_slice(ManagerEvenement::all(), 0, 4);
        $musique   = ManagerEvenement::findAllOrdered("musique");
        $culture   = ManagerEvenement::findAllOrdered("culture");
        $loisir    = ManagerEvenement::findAllOrdered("loisir");
        require_once("views/pages/home.php");
    }

    public function index_admin() {
        $evenement                = ManagerEvenement::all();
        $covoiturage              = ManagerCovoiturage::all();
        $utilisateurs_en_attente  = ManagerUser::getEnAttente();
        require_once("views/admin/index.php");
    }

    public function profil() {
        $id = isset($_GET["id"]) ? $_GET["id"] : $_SESSION["id"];

        $profil          = ManagerUser::all($id);
        $profil_event    = ManagerUser::get($id);
        $profil_participe = ManagerParticipant::getById($id);
        require_once("views/pages/profil.php");
    }

    public function chance() {
        $categories = ManagerUser::getCategorieUser($_SESSION["id"]);
        $evenements = ManagerUser::getEvenementsRecommandes($_SESSION["id"]);
        require_once("views/pages/chance.php");
    }

    public function validerCompte() {
        ManagerUser::validerCompte($_GET["id"], $_GET["statut"]);
        header('Location: ?controller=pages&action=index_admin');
        exit;
    }
}