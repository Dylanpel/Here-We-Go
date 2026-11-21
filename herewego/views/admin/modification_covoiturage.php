<form action="?controller=covoiturage&action=update" method="POST">
    Nombre de place: <input type="text" name="nombreplace" value="<?php echo $covoiturage->getNombre_place_dispo(); ?>"><br>
    Vehicule :<input type="texte" name="vehicule" value="<?php echo $covoiturage->getVehicule(); ?>"><br>
    Description : <br><textarea name="description" rows="5" cols="33">
        <?php echo $covoiturage->getDescription(); ?>
    </textarea><br>
    montant : <input type="text" name="montant" value="<?php echo $covoiturage->getMontant(); ?>"><br>
    Photo du véhicule : <input type="url" name="mediaUrlVoiture" value="<?php echo $covoiturage->getMedia_url_voiture(); ?>"><br>
    <input type="texte" name="id_utilisateur" value="<?php echo $covoiturage->getId_utilisateur(); ?>">
    <input type="hidden" name="id_evenement" value="<?php echo $covoiturage->getId_evenement(); ?>">
    <input type="hidden" name="id" value="<?php echo $covoiturage->getId_covoiturage(); ?>">
    <input type="text" name="codepostal" id="monInput" placeholder="Code postal">
    <input type="text" name="ville" id="villeInput" placeholder="Ville">
    <input type="text" name="departement" id="departementInput" placeholder="departement">
    <div id="result"></div>
    <input type="submit" value="Valider">
</form>