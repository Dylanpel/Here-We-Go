

<div class="carte-event">
  <?php if(!empty($evenements)){ ?>
      <?php foreach($evenements as $info){ ?>
        <div class="event-card">
          <div class="event-photo-wrap ">
            <?php if($info->getUrl_media()){
              ?><img src="<?php echo $info->getUrl_media(); ?>" alt="Titre événement">
               <span class="cat-badge"><?php echo $info->getCategorie(); ?></span>
            <?php } else {
              ?><img src="https://cdn.pixabay.com/photo/2016/11/23/15/48/audience-1853662_1280.jpg" alt="Titre événement">
               <span class="cat-badge"><?php echo $info->getCategorie(); ?></span>
            <?php } ?>
          </div>
          <div class="event-body">
            <div class="event-date-row">
              <span class="date-pill"><?= $info->getDate_debut_evenement(); ?></span>
              <span class="time-text"><?= $info->getHeure_evenement(); ?></span>
            </div>
            <h2 class="event-title"><?php echo $info->getLibelle(); ?></h2>
            <p class="event-desc"><?php echo $info->getDescription(); ?></p>
            <div class="event-footer">
              <div class="event-lieu">
                <svg width="13" height="13" viewBox="0 0 16 16" fill="none">
                  <path d="M8 1a5 5 0 0 1 5 5c0 3.5-5 9-5 9S3 9.5 3 6a5 5 0 0 1 5-5zm0 3a2 2 0 1 0 0 4 2 2 0 0 0 0-4z" fill="currentColor"/>
                </svg>
                <span><?= $info->getAdresse(); ?></span>
                <span><?= $info->getNom_ville(); ?></span>
              </div>
              <a href="?controller=evenement&action=page_evenement&id=<?php echo $info->getId_evenement(); ?>" class="btn-detail">Voir →</a>
            </div>
          </div>
        </div>

        
        
      
  <?php } } else { ?>
        <p>Aucun événement trouvé pour cette catégorie.</p> <?php } ?>
</div>
<nav aria-label="Pagination" class="d-flex justify-content-center align-items-center gap-2 mt-4">

    <!-- Précédent -->
    <?php if ($page <= 0){ ?>
        <span class="px-4 py-2 rounded-pill border text-muted" 
              style="background:#f0ece4; cursor:not-allowed; font-size:0.9rem;">
            ← Précédent
        </span>
    <?php }else{ ?>
        <a class="px-4 py-2 rounded-pill border text-dark text-decoration-none"
           style="background:#f0ece4; font-size:0.9rem;"
           href="?controller=evenement&action=page_categorie&categorie=<?= htmlspecialchars($libelle) ?>&page=<?= $page - 1 ?>">
            ← Précédent
        </a>
    <?php } ?>

    <!-- Page X / Y -->
    <span class="px-4 py-2 rounded-pill border text-dark"
          style="background:#ffffff; font-size:0.9rem;">
        Page <?= $page + 1 ?> / <?= $pageMax ?>
    </span>

    <!-- Suivant -->
    <?php if ($page + 1 >= $pageMax){ ?>
        <span class="px-4 py-2 rounded-pill border text-muted"
              style="background:#f0ece4; cursor:not-allowed; font-size:0.9rem;">
            Suivant →
        </span>
    <?php } else { ?>
        <a class="px-4 py-2 rounded-pill border text-dark text-decoration-none"
           style="background:#f0ece4; font-size:0.9rem;"
           href="?controller=evenement&action=page_categorie&categorie=<?= htmlspecialchars($libelle) ?>&page=<?= $page + 1 ?>">
            Suivant →
        </a>
    <?php } ?>

</nav>