<div class="container py-5">
    <h2 class="mb-4 text-center">Liste des utilisateurs</h2>
    <div class="row g-3">
        <?php foreach ($utilisateur as $info) { ?>
        <div class="col-md-6 col-lg-4">
            <a href="?controller=pages&action=profil&id=<?php echo $info->getId_utilisateur(); ?>" class="text-decoration-none text-dark">
                <div class="card user-card p-3 h-100">
                    <h5 class="card-title"><?php echo $info->getPseudo(); ?></h5>
                    <p class="mb-1"><strong>Nom: </strong><?php echo $info->getNom(); ?></p>
                    <p class="mb-1"><strong>Prénom: </strong><?php echo $info->getPrenom(); ?></p>
                    <p class="mb-0"><strong>Email: </strong><?php echo $info->getEmail(); ?></p>
                    <p><a href="?controller=user&action=page_modification&id=<?php echo $info->getId_utilisateur(); ?>">Modifier</a></p>
                    <p><a href="?controller=user&action=delete&id=<?php echo $info->getId_utilisateur(); ?>">Supprimer</a></p>
                </div>
            </a>
        </div>
        <?php } ?>
    </div>
</div>