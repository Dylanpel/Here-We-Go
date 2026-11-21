.
<?php
class Categorie{
    private $id_catgorie;
    private $libelle;
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
    public function getId_catgorie(){
    return $this->id_catgorie;
    }
    public function setId_catgorie($id_catgorieC){
        $this->id_catgorie=$id_catgorieC;
        return $this;
    }
     public function getlibelle(){
    return $this->libelle;
    }
    public function setLibelle($libelleC){
        $this->libelle=$libelleC;
        return $this;
    }
}
?>