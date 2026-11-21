<?php
class Utilisateur {
    private $id_utilisateur;
    private $email;
    private $password;
    private $pseudo;
    private $nom;
    private $prenom;
    private $date_de_naissance;
    private $adresse;
    private $numeros_telephone;
    private $id_ville;
    private $id_role;
    private $role;
    private $verouille;
    private $avatar_url;
    private $compteur_evenement;
    private $statut;
    private $nom_ville;
    private $code_postal;
    private $departement;
    
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
    public function setId_utilisateur($id_utilisateurU){
        $this->id_utilisateur=$id_utilisateurU;
        return $this;
    }
    public function getEmail(){
    return $this->email;
    }
    public function setEmail($emailU){
        $this->email=$emailU;
        return $this;
    }
    public function getPassword(){
    return $this->password;
    }
    public function setPassword($passwordU){
        $this->password=$passwordU;
        return $this;
    }
    public function getPseudo(){
    return $this->pseudo;
    }
    public function setPseudo($pseudoU){
        $this->pseudo=$pseudoU;
        return $this;
    }
    public function getNom(){
    return $this->nom;
    }
    public function setNom($nomU){
        $this->nom=$nomU;
        return $this;
    }
    public function getPrenom(){
    return $this->prenom;
    }
    public function setPrenom($prenomU){
        $this->prenom=$prenomU;
        return $this;
    }
    public function getDate_de_naissance(){
    return $this->date_de_naissance;
    }
    public function setDate_de_naissance($date_de_naissanceU){
        $this->date_de_naissance=$date_de_naissanceU;
        return $this;
    }
    public function getAdresse(){
    return $this->adresse;
    }
    public function setAdresse($adresseU){
        $this->adresse=$adresseU;
        return $this;
    }
    public function getNumeros_telephone(){
    return $this->numeros_telephone;
    }
    public function setNumeros_telephone($numeros_telephoneU){
        $this->numeros_telephone=$numeros_telephoneU;
        return $this;
    }
    public function getId_ville(){
    return $this->id_ville;
    }
    public function setId_ville($id_villeU){
        $this->id_ville=$id_villeU;
        return $this;
    }
    public function getId_role(){
    return $this->id_role;
    }
    public function setId_role($id_roleU){
        $this->id_role=$id_roleU;
        return $this;
    }

    public function getVerouille()
    {
        return $this->verouille;
    }

    public function setVerouille($verouilleU): self
    {
        $this->verouille = $verouilleU;

        return $this;
    }

    public function getRole()
    {
        return $this->role;
    }

    public function setRole($role): self
    {
        $this->role = $role;

        return $this;
    }

    public function getAvatar_url()
    {
        return $this->avatar_url;
    }

    public function setAvatar_url($avatar_url): self
    {
        $this->avatar_url = $avatar_url;

        return $this;
    }

    public function getCompteur_evenement()
    {
        return $this->compteur_evenement;
    }

    public function setCompteur_evenement($compteur_evenement): self
    {
        $this->compteur_evenement = $compteur_evenement;

        return $this;
    }

    /**
     * Get the value of statut
     */
    public function getStatut()
    {
        return $this->statut;
    }

    /**
     * Set the value of statut
     */
    public function setStatut($statut): self
    {
        $this->statut = $statut;

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
}
?>