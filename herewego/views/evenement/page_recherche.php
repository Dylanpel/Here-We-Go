<div class="container py-5">
    <h2 class="mb-4">Résultats de recherche</h2>

    <?php if(empty($recherche)) { ?>
        <p>Aucun événement trouvé.</p>
    <?php } else { ?>
        <div class="row g-3">
            <?php foreach($recherche as $info) { ?>
            <div class="col-md-6 col-lg-4">
                <a href="?controller=evenement&action=page_evenement&id=<?php echo $info->getId_evenement(); ?>" class="text-decoration-none text-dark">
                    <div class="event-card">
                        <div class="event-banner">
                            <img src="<?php echo $info->getUrl_media() ?: 'https://cdn.pixabay.com/photo/2016/11/23/15/48/audience-1853662_1280.jpg'; ?>" class="img-fluid object-fit-cover">
                        </div>
                        <div class="event-body">
                            <div class="d-flex align-items-center mb-1">
                                <span class="event-tag"><?php echo $info->getCategorie(); ?></span>
                                <span class="event-date-badge ms-auto"><?php echo date('d/m/Y', strtotime($info->getDate_debut_evenement())); ?></span>
                            </div>
                            <div class="event-title"><?php echo $info->getLibelle(); ?></div>
                            <div class="event-desc"><?php echo $info->getDescription(); ?></div>
                            <div class="event-location">
                                <i class="bi bi-geo-alt me-1"></i><?php echo $info->getNom_ville(); ?>
                                <?php if($info->getDepartement()) { ?>
                                    (<?php echo $info->getDepartement(); ?>)
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <?php } ?>
        </div>
    <?php } ?>
</div>