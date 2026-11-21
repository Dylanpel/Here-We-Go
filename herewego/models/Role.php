<?php 

    class Role {
        private $id_role;
        private $libelle;

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

        public function getIdRole()
        {
                return $this->id_role;
        }

        public function setIdRole($id_roleR): self
        {
                $this->id_role = $id_roleR;

                return $this;
        }

        public function getLibelle()
        {
                return $this->libelle;
        }

        public function setLibelle($libelleR): self
        {
                $this->libelle = $libelleR;

                return $this;
        }
    }



?>