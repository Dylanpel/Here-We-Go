<?php
require_once(__DIR__ . "/../models/Participant.php");
require_once(__DIR__ . "/../models/ManagerParticipant.php");
require_once(__DIR__ . "/../models/ManagerUser.php");

class ParticipantController {

    public function participer() {
        $error = [];
        if(empty($_POST["id_evenement"])){
            $error[]="l'évenement est obligatoire";
        }
        if(empty($_POST["id_utilisateur"])){
            $error[]="Il faut être connecté pour pouvoir participer";
        }
        if(empty($error)){
            $manager = new ManagerParticipant();
            $manager->participerEvenement($_POST["id_evenement"], $_POST["id_utilisateur"]);
    
            $update = new ManagerUser();
            $update->updateCompteur($_SESSION["id"]);
    
            header('Location: ?controller=pages&action=home');
            exit;
        } else {
            $_SESSION['errors'] = $error;
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;
        }
    } 
}