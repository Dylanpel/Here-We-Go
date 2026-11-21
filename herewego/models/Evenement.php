<?php
class Evenement {
    private $libelle;
    private $description;
    private $date_debut_evenement;
    private $date_fin_evenement;
    private $heure_evenement;
    private $adresse;
    private $id_utilisateur;
    private $id_evenement;
    private $url_media;
    private $archivage;
    private $validation; 
    private $id_ville;
    private $nom;
    private $prenom;
    private $nom_ville;
    private $code_postal;
    private $departement;
    private $categorie;
    private $pseudo;
    private $nb_participants;
        
    public function __construct($valeur=[])
    {
        if(!empty($valeur))
            $this->hydrate($valeur);
    }
    public function hydrate($list){
        foreach ($list as $key => $value)
            {
                $method='set'.ucfirst($key);
                if(method_exists($this,$method)){
                    $this->$method($value);
                }else{
                    echo $method." introuvable";
                }
            }
    }
    public function getLibelle(){
    return $this->libelle;
    }
    public function setLibelle($libelleE){
        $this->libelle=$libelleE;
        return $this;
    }
    public function getDescription(){
    return $this->description;
    }
    public function setDescription($descriptionE){
        $this->description=$descriptionE;
        return $this;
    }
    public function getDate_debut_evenement(){
    return $this->date_debut_evenement;
    }
    public function setDate_debut_evenement($date_debut_evenementE){
        $this->date_debut_evenement=$date_debut_evenementE;
        return $this;
    }
    public function getDate_fin_evenement(){
    return $this->date_fin_evenement;
    }
    public function setDate_fin_evenement($date_fin_evenementE){
        $this->date_fin_evenement=$date_fin_evenementE;
        return $this;
    }
    public function getHeure_evenement(){
    return $this->heure_evenement;
    }
    public function setHeure_evenement($heure_evenementE){
        $this->heure_evenement=$heure_evenementE;
        return $this;
    }
    public function getAdresse(){
    return $this->adresse;
    }
    public function setAdresse($adresseE){
        $this->adresse=$adresseE;
        return $this;
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

    public function getUrl_media()
    {
        return $this->url_media;
    }

    public function setUrl_media($url_mediaE): self
    {
        $this->url_media = $url_mediaE;

        return $this;
    }

    public function getArchivage()
    {
        return $this->archivage;
    }

    public function setArchivage($archivageE): self
    {
        $this->archivage = $archivageE;

        return $this;
    }

    public function getValidation()
    {
        return $this->validation;
    }

    public function setValidation($validationE): self
    {
        $this->validation = $validationE;

        return $this;
    }

    public function getId_ville()
    {
        return $this->id_ville;
    }

    public function setId_ville($id_villeE): self
    {
        $this->id_ville = $id_villeE;

        return $this;
    }

    public function getNom()
    {
        return $this->nom;
    }

    public function setNom($nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom()
    {
        return $this->prenom;
    }

    public function setPrenom($prenom): self
    {
        $this->prenom = $prenom;

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

    public function getCode_postal()
    {
        return $this->code_postal;
    }

    public function setCode_postal($code_postal): self
    {
        $this->code_postal = $code_postal;

        return $this;
    }

    public function getDepartement()
    {
        return $this->departement;
    }

    public function setDepartement($departement): self
    {
        $this->departement = $departement;

        return $this;
    }

    public function getCategorie()
    {
        return $this->categorie;
    }

    public function setCategorie($categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }
    public function getPseudo(){
    return $this->pseudo;
    }
    public function setPseudo($pseudoU){
        $this->pseudo=$pseudoU;
        return $this;
}

    public function getNb_participants()
    {
        return $this->nb_participants;
    }

    public function setNb_participants($nb_participants): self
    {
        $this->nb_participants = $nb_participants;

        return $this;
    }
}
?>