
<div class="container py-5">
    <h2 class="mb-4 text-center">Liste des Evenements</h2>
    <div class="row g-3">
        <?php foreach ($evenement as $info) { ?>
        <div class="col-md-6 col-lg-4">
            <a href="?controller=evenement&action=page_evenement&id=<?php echo $info->getId_evenement(); ?>" class="text-decoration-none text-dark">
                <div class="card user-card p-3 h-100">
                    <h5 class="card-title"><?php echo $info->getLibelle(); ?></h5>
                    <p class="mb-1"><strong>Titre: </strong><?php echo $info->getDescription(); ?></p>
                    <p class="mb-1"><strong>Date Début evenement: </strong><?php echo date('d/m/Y', strtotime($info->getDate_debut_evenement())); ?></p>
                    <p class="mb-0"><strong>Adresse: </strong><?php echo $info->getAdresse(); ?></p>
                    <p class="mb-1"><strong>Ville: </strong><?php echo $info->getNom_ville(); ?></p>
                    <p class="mb-0"><strong>Organisateur: </strong><?php echo $info->getPseudo(); ?></p>
                    <p><a href="?controller=evenement&action=page_modification&id=<?php echo $info->getId_evenement(); ?>">Modifier</a></p>
                    <p><a href="?controller=evenement&action=delete&id=<?php echo $info->getId_evenement(); ?>">Supprimer</a></p>
                </div>
            </a>
        </div>
        <?php } ?>
    </div>
</div>