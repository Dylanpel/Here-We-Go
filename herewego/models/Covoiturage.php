<?php

    class Covoiturage {
        private $id_covoiturage;
        private $nombre_place_dispo;
        private $vehicule;
        private $description;
        private $id_utilisateur;
        private $id_evenement;
        private $montant;
        private $media_url_voiture;
        private $libelle;
        private $telephone;
        private $email;
        private $places_restantes;
        private $pseudo;
        private $nom_ville;
        private $date_debut_evenement;
        private $adresse;
        
        public function __construct($valeur=[]){
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

       public function getId_covoiturage() {
    return $this->id_covoiturage;
}
public function setId_covoiturage($id_covoiturageC): self {
    $this->id_covoiturage = $id_covoiturageC;
    return $this;
}

public function getId_utilisateur() {
    return $this->id_utilisateur;
}
public function setId_utilisateur($id_utilisateurC): self {
    $this->id_utilisateur = $id_utilisateurC;
    return $this;
}

public function getId_evenement() {
    return $this->id_evenement;
}
public function setId_evenement($id_evenementC): self {
    $this->id_evenement = $id_evenementC;
    return $this;
}

public function getLibelle() {
    return $this->libelle;
}
public function setLibelle($libelleC): self {
    $this->libelle = $libelleC;
    return $this;
}

public function getNombre_place_dispo() {
    return $this->nombre_place_dispo;
}
public function setNombre_place_dispo($nombre_place_dispoC): self {
    $this->nombre_place_dispo = $nombre_place_dispoC;
    return $this;
}

public function getMedia_url_voiture() {
    return $this->media_url_voiture;
}
public function setMedia_url_voiture($mediaC): self {
    $this->media_url_voiture = $mediaC;
    return $this;
    }
public function getVehicule() {
    return $this->vehicule;
}
public function setVehicule($vehiculeC): self {
    $this->vehicule = $vehiculeC;
    return $this;
}

public function getMontant() {
    return $this->montant;
}
public function setMontant($montantC): self {
    $this->montant = $montantC;
    return $this;
}

public function getDescription() {
    return $this->description;
}
public function setDescription($descriptionC): self {
    $this->description = $descriptionC;
    return $this;
}

        public function getTelephone()
        {
                return $this->telephone;
        }

        public function setTelephone($telephone): self
        {
                $this->telephone = $telephone;

                return $this;
        }

        public function getEmail()
        {
                return $this->email;
        }

        public function setEmail($email): self
        {
                $this->email = $email;

                return $this;
        }

        /**
         * Get the value of place_restantes
         */
        public function getPlacesRestantes()
        {
                return $this->places_restantes;
        }

        /**
         * Set the value of place_restantes
         */
        public function setPlacesRestantes($places_restantes): self
        {
                $this->places_restantes = $places_restantes;

                return $this;
        }

        /**
         * Get the value of pseudo
         */
        public function getPseudo()
        {
                return $this->pseudo;
        }

        /**
         * Set the value of pseudo
         */
        public function setPseudo($pseudo): self
        {
                $this->pseudo = $pseudo;

                return $this;
        }
        public function getNom_ville()
        {
                return $this->nom_ville;
        }

        public function setNom_ville($nom_ville): self
        {
                $this->nom_ville = $nom_ville;

                return $this;
        }
        public function getDate_debut_evenement()
        {
                return $this->date_debut_evenement;
        }

        public function setDate_debut_evenement($date_debut_evenement): self
        {
                $this->date_debut_evenement = $date_debut_evenement;

                return $this;
        }
    public function getAdresse()
        {
                return $this->adresse;
        }

        public function setAdresse($adresse): self
        {
                $this->adresse = $adresse;

                return $this;
        }
}