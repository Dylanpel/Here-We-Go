<div class="container py-5">
    <h2 class="mb-4 text-center">Liste des Covoiturages</h2>
    <div class="row g-3">
        <?php foreach ($covoiturage as $info) { ?>
        <div class="col-md-6 col-lg-4">
            <a href="?controller=evenement&action=page_evenement&id=<?php echo $info->getId_evenement(); ?>" class="text-decoration-none text-dark">
                <div class="card user-card p-3 h-100">
                    <h5 class="card-title"><?php echo $info->getLibelle(); ?></h5>
                    <p class="mb-1"><strong>Date Début: </strong><?php echo $info->getDate_debut_evenement(); ?></p>
                    <p class="mb-1"><strong>Adresse: </strong><?php echo $info->getAdresse(); ?></p>
                    <p class="mb-1"><strong>Ville: </strong><?php echo $info->getNom_ville(); ?></p>
                    <p class="mb-1"><strong>Organisateur: </strong>
                        <a href="?controller=pages&action=profil&id=<?php echo $info->getId_utilisateur(); ?>">
                            <?php echo $info->getPseudo(); ?>
                        </a>
                    </p>
                    <p class="mb-1"><strong>Véhicule: </strong><?php echo $info->getVehicule(); ?></p>
                    <p class="mb-1"><strong>Montant: </strong><?php echo $info->getMontant(); ?> €</p>
                    <p class="mb-0"><strong>Places dispo: </strong><?php echo $info->getNombre_place_dispo(); ?></p>
                    <p><a href="?controller=covoiturage&action=page_modification&id=<?php echo $info->getId_covoiturage(); ?>">Modifier</a></p>
                    <p><a href="?controller=covoiturage&action=delete&id=<?php echo $info->getId_covoiturage(); ?>">Supprimer</a></p>
                </div>
            </a>
        </div>
        <?php } ?>
    </div>
</div>