<?php
require_once(__DIR__ . "/../models/ManagerNotification.php");

class NotificationController {

    public function index() {
        if(isset($_SESSION["id"])) {
            ManagerNotification::markAllRead($_SESSION["id"]);
            header('Location: ?controller=covoiturage&action=page_covoiturage');
            exit;
        } else {
            header('Location: ?controller=user&action=page_connexion');
            exit;
        }
    }

    public function delete() {
        if(isset($_SESSION["id"])) {
            ManagerNotification::delete($_GET["id"]);
            header('Location: ?controller=covoiturage&action=page_covoiturage');
            exit;
        } else {
            header('Location: ?controller=user&action=page_connexion');
            exit;
        }
    }
}