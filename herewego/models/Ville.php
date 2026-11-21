<?php

    class Ville {
        private $id_ville;
        private $ville;
        private $code_postal;
        private $departement;

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

        public function getIdVille()
        {
                return $this->id_ville;
        }

        public function setIdVille($id_villeV): self
        {
                $this->id_ville = $id_villeV;

                return $this;
        }

        public function getVille()
        {
                return $this->ville;
        }

        public function setVille($villeV): self
        {
                $this->ville = $villeV;

                return $this;
        }

        public function getCodePostal()
        {
                return $this->code_postal;
        }

        public function setCodePostal($code_postalV): self
        {
                $this->code_postal = $code_postalV;

                return $this;
        }

        public function getDepartement()
        {
                return $this->departement;
        }

        public function setDepartement($departementV): self
        {
                $this->departement = $departementV;

                return $this;
        }
    }



?>