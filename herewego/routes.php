<?php
    function call($controller, $action) {
        require_once 'controller/'.$controller."_controller.php";

        switch($controller) {
            case "pages":
                $controller=new PagesController();
                break;
            
            case "evenement":
                $controller=new EvenementController();
                break;
            
            case "user":
                $controller=new UserController();
                break;
            
            case "covoiturage":
                $controller=new CovoiturageController();
                break;

            case "participant":
                $controller=new ParticipantController();
                break;

            case "participer":
                $controller=new ParticiperController();
                break;
            
            case"notification":
                $controller=new NotificationController();
                break;


        }

        $controller->{$action}();
    }

    $controllers=array("pages"=>["home","index_admin","index_covoiturage","profil","chance","validerCompte"], 
                       "evenement"=>["list","insert","ajouter","delete","page_modification","update","page_evenement","page_categorie","recherche","exportCsv","exportCsvAll","recherche_proximite"],
                       "user"=>["page_inscription","inscrire","page_connexion","connection","deconecter","list","delete","page_modification","update"],
                       "covoiturage"=>["list","update","page_modification","delete","insert",
                       "ajouter","page_covoiturage","getByCovoit","rejoindreCovoit"],
                       "participant"=>["participer","list","get"],
                       "participer"=>["formurejoindreCovoit","ajouter","mesEvenements","validerDemande","supprimerDemande"],
                       "notification"=>["index","delete"]);


     if(array_key_exists($controller, $controllers)) {
        if(in_array($action, $controllers[$controller])) {
            call($controller, $action);
        } else {
            call("pages","error");
        }
    } else {
       call("pages","error"); 
    }

?>