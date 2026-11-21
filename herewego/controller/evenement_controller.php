<?php
require_once(__DIR__ . "/../models/Evenement.php");
require_once(__DIR__ . "/../models/ManagerEvenement.php");
require_once(__DIR__ . "/../models/Utilisateur.php");
require_once(__DIR__ . "/../models/ManagerUser.php");
require_once(__DIR__ . "/../models/Participant.php");
require_once(__DIR__ . "/../models/ManagerParticipant.php");
require_once(__DIR__ . "/../models/ManagerCategorie.php");

class EvenementController {

    public function list() {
        $evenement = ManagerEvenement::all();
        require_once("views/evenement/list.php");
    }

    public function recherche() {
        $result      = trim($_POST["recherche"] ?? "");
        $date_debut  = trim($_POST["date_debut"] ?? "");
        $date_fin    = trim($_POST["date_fin"] ?? "");
        $departement = trim($_POST["departement"] ?? "");

        $recherche = ManagerEvenement::findSearch($result, $date_debut, $date_fin, $departement);
        require_once("views/evenement/page_recherche.php");
    }

    public function insert() {
        $categories = ManagerCategorie::all();
        require_once("views/pages/form_ajouter.php");
    }

    public function ajouter() {
        $error = [];

        if(empty($_POST["titre"])) {
            $error[] = "Le titre est obligatoire";
        }
        if(empty($_POST["description"])) {
            $error[] = "La description est obligatoire";
        }
        if(empty($_POST["categorie"])) {
            $error[] = "La catégorie est obligatoire";
        }
        if(empty($_POST["date_debut_evenement"])) {
            $error[] = "Il faut renseigner la date de début d'événement";
        }
        if(empty($_POST["heure_evenement"])) {
            $error[] = "Il faut renseigner l'heure d'événement";
        }
        if(empty($_POST["adresse"])) {
            $error[] = "Il faut renseigner l'adresse de l'événement";
        }

        if(empty($error)) {
            $evenement = new Evenement([
                'libelle'              => $_POST["titre"],
                'url_media'            => $_POST["url_media"],
                'description'          => $_POST["description"],
                'date_debut_evenement' => $_POST["date_debut_evenement"],
                'date_fin_evenement'   => $_POST["date_fin_evenement"],
                'heure_evenement'      => $_POST["heure_evenement"],
                'adresse'              => $_POST["adresse"],
                'id_ville'             => $_POST["id_ville"],
                'id_utilisateur'       => $_SESSION["id"],
            ]);

            $manager = new ManagerEvenement();
            $result = $manager->addEvenement($evenement, $_POST["categorie"]);

            if($result) {
            $_SESSION['success'] = "Événement ajouté avec succès !";
            header('Location: ?controller=evenement&action=page_evenement&id=' . $result);
            exit;
            } else {
                $error[] = "Erreur lors de l'enregistrement";
            }
        }

        $categories = ManagerCategorie::all();
        require_once("views/pages/form_ajouter.php");
    }

    public function delete() {
        $evenement = new Evenement([
            "id_evenement" => $_GET["id"]
        ]);
        $manager = new ManagerEvenement();
        $manager->delete($evenement);

        header('Location: ?controller=evenement&action=list');
        exit;
    }

    public function page_modification() {
        $evenement = ManagerEvenement::get($_GET["id"]);
        $categories = ManagerCategorie::all();
        require_once("views/admin/modification_evenement.php");
    }

   public function update() {
    $error = [];

    if(empty($_POST["titre"]))                $error[] = "Le titre est obligatoire";
    if(empty($_POST["description"]))          $error[] = "La description est obligatoire";
    if(empty($_POST["date_debut_evenement"])) $error[] = "La date de début est obligatoire";
    if(empty($_POST["heure_evenement"]))      $error[] = "L'heure est obligatoire";
    if(empty($_POST["adresse"]))              $error[] = "L'adresse est obligatoire";

    if(empty($error)) {

        $id_ville = !empty($_POST["id_ville"]) 
            ? $_POST["id_ville"] 
            : ManagerEvenement::get($_POST["id"])->getId_ville();

        $up = new Evenement([
            "libelle"              => $_POST["titre"],
            "url_media"            => $_POST["url_media"],
            "description"          => $_POST["description"],
            "date_debut_evenement" => $_POST["date_debut_evenement"],
            "date_fin_evenement"   => $_POST["date_fin_evenement"],
            "heure_evenement"      => $_POST["heure_evenement"],
            "adresse"              => $_POST["adresse"],
            "id_utilisateur"       => $_POST["id_utilisateur"],
            "id_ville"             => $id_ville,
            "id_evenement"         => $_POST["id"]
        ]);

        $manager = new ManagerEvenement();
        $manager->update($up, $_POST["categorie"]);

        header('Location: ?controller=evenement&action=list');
        exit;
    }

    $evenement = ManagerEvenement::get($_POST["id"]);
    $categories = ManagerCategorie::all();
    require_once("views/admin/modification_evenement.php");
}

    public function page_evenement() {
        $participe = ManagerParticipant::getById($_GET["id"]);
        $evenement = ManagerEvenement::get($_GET["id"]);
        $user = isset($_SESSION["id"]) ? ManagerUser::all($_SESSION["id"]) : [];
        require_once("views/evenement/page_evenement.php");
    }

    public function page_categorie() {
        $libelle = isset($_GET["categorie"]) ? $_GET["categorie"] : "";
        $page    = isset($_GET["page"]) ? max(0, (int) $_GET["page"]) : 0;
        $limit   = 4;
        $offset  = $page * $limit;

        $evenements = ManagerEvenement::findAllOrdered($libelle, $limit, $offset);
        $total      = ManagerEvenement::countByLibelle($libelle);
        $pageMax    = (int) ceil($total / $limit);

        require_once("views/evenement/page_categorie.php");
    }

    public function exportCsv() {
        $id       = $_GET["id"] ?? '';
        $evenement = ManagerEvenement::get($id);

        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename="evenement_' . $evenement->getLibelle() . '.csv"');

        $output = fopen('php://output', 'w');
        fprintf($output, chr(0xEF).chr(0xBB).chr(0xBF));

        fputcsv($output, ['Titre', 'Heure', 'Description', 'Auteur', 'Adresse', 'Ville', 'Code Postal'], ';');
        fputcsv($output, [
            $evenement->getLibelle(),
            $evenement->getHeure_evenement(),
            $evenement->getDescription(),
            $evenement->getPrenom() . ' ' . $evenement->getNom(),
            $evenement->getAdresse(),
            $evenement->getNom_ville(),
            $evenement->getCode_postal()
        ], ';');

        fclose($output);
        exit;
    }

    public function exportCsvAll() {
        $evenements = ManagerUser::get($_SESSION["id"]);

        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename="mes_evenements.csv"');

        $output = fopen('php://output', 'w');
        fprintf($output, chr(0xEF).chr(0xBB).chr(0xBF));

        fputcsv($output, ['Titre', 'Heure', 'Description', 'Adresse', 'Ville', 'Code Postal', 'Catégorie'], ';');

        foreach($evenements as $evenement) {
            fputcsv($output, [
                $evenement->getLibelle(),
                $evenement->getDate_debut_evenement(),
                $evenement->getDescription(),
                $evenement->getAdresse(),
                $evenement->getNom_ville(),
                $evenement->getCode_postal(),
                $evenement->getCategorie()
            ], ';');
        }

        fclose($output);
        exit;
    }

    public function recherche_proximite() {
        $departement = isset($_GET["departement"]) ? $_GET["departement"] : null;

        if(!$departement && isset($_SESSION["id"])) {
            $user = ManagerUser::getById($_SESSION["id"]);
            $departement = $user->getDepartement();
        }

        $evenements = $departement ? ManagerEvenement::findByDepartement($departement) : [];
        require_once("views/evenement/recherche_proximite.php");
    }
}