<?php
require_once 'connexionbdd.php';
require_once 'ManagerVille.php';

$info = new ManagerVille();
if(isset($_GET['codepostal'])){
            echo json_encode($info->autocompletionCodepostal($_GET['codepostal']));
            exit;
        }
        if(isset($_GET['ville'])){
            echo json_encode($info->autocompletionVille($_GET['ville']));
            exit;
        }
        echo json_encode([]);
