<?php

class Participant{

    private $id_utilisateur;
    private $id_evenement;

    public function __construct($valeur=[])
    {
        if(!empty($valeur))
            $this->hydrate($valeur);
    }
    public function hydrate($donnees){
        foreach ($donnees as $key =>$value)
            {
                $method='set'.ucfirst($key);
                if(method_exists($this,$method)){
                    $this->$method($value);
                }else{
                    echo $method." introuvable";
                }
            }
    }
    public function getId_utilisateur(){
    return $this->id_utilisateur;
    }
    public function setId_utilisateur($id_utilisateurE){
        $this->id_utilisateur=$id_utilisateurE;
        return $this;
    }
    public function getId_evenement(){
    return $this->id_evenement;
    }
    public function setId_evenement($id_evenementE){
        $this->id_evenement=$id_evenementE;
        return $this;
    }

    


}