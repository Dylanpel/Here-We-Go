<?php
class Participer {
    private $quantite;
    private $id_utilisateur;
    private $id_covoiturage;

    public function __construct($valeur = []) {
        if (!empty($valeur))
            $this->hydrate($valeur);
    }

    public function hydrate($donnees) {
        foreach ($donnees as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (method_exists($this, $method)) {
                $this->$method($value);
            } else {
                echo $method . " introuvable";
            }
        }
    }

    public function getQuantite() {
        return $this->quantite;
    }
    public function setQuantite($quantiteP) {
        $this->quantite = $quantiteP;
        return $this;
    }

    public function getId_utilisateur() {
        return $this->id_utilisateur;
    }
    public function setId_utilisateur($id_utilisateurP) {
        $this->id_utilisateur = $id_utilisateurP;
        return $this;
    }

    public function getId_covoiturage() {
        return $this->id_covoiturage;
    }
    public function setId_covoiturage($id_covoiturageP) {
        $this->id_covoiturage = $id_covoiturageP;
        return $this;
    }
}
?>