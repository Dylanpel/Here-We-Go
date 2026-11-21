<?php
class Notification {
    private $id_notification;
    private $id_utilisateur;
    private $message;
    private $lu;
    private $date_creation;

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
    public function getIdNotification()
    {
        return $this->id_notification;
    }
    public function setIdNotification($id_notification): self
    {
        $this->id_notification = $id_notification;

        return $this;
    }
    public function getIdUtilisateur()
    {
        return $this->id_utilisateur;
    }
    public function setIdUtilisateur($id_utilisateur): self
    {
        $this->id_utilisateur = $id_utilisateur;

        return $this;
    }
    public function getMessage()
    {
        return $this->message;
    }
    public function setMessage($message): self
    {
        $this->message = $message;

        return $this;
    }
    public function getLu()
    {
        return $this->lu;
    }
    public function setLu($lu): self
    {
        $this->lu = $lu;

        return $this;
    }
    public function getDateCreation()
    {
        return $this->date_creation;
    }
    public function setDateCreation($date_creation): self
    {
        $this->date_creation = $date_creation;

        return $this;
    }
}