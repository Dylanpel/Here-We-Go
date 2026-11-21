<?php
session_start();
ob_start();
require_once('connexion.php');

if (isset($_GET['controller']) && isset($_GET['action'])) {
    $controller = $_GET['controller'];
    $action = $_GET['action'];
} else {
    $controller = 'pages';
    $action = 'home';
}

if($controller === 'evenement' && ($action === 'exportCsv' || $action === 'exportCsvAll')) {
    require_once('controller/evenement_controller.php');
    $c = new EvenementController();
    $c->$action();
    ob_end_clean();
    exit();
}

require_once('views/layout.php');
ob_end_flush();
?>
