<?php 
$errors = $_SESSION['errors'] ?? [];
unset($_SESSION['errors']);
if(!empty($errors)) { ?>
        <div class="alert alert-danger alert-dismissible" role="alert">
            <ul class="mb-0">
                <?php foreach($errors as $err) { ?>
                    <li><?php echo htmlspecialchars($err); ?></li>
                <?php } ?>
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php } ?>

<div class="container py-4">
  <div class="row g-4">


    <div class="col-lg-8">
      <div class="detail-hero">
        <img class="detail-hero-img"
             src="<?php echo $evenement->getUrl_media() ?: 'https://cdn.pixabay.com/photo/2016/11/23/15/48/audience-1853662_1280.jpg'; ?>"
             alt="<?php echo $evenement->getLibelle(); ?>">

        <div class="detail-body">
          <span class="detail-tag"><?php echo $evenement->getCategorie(); ?></span>
          <h1 class="detail-title"><?php echo $evenement->getLibelle(); ?></h1>
          <p class="detail-author">
            Par <a href="?controller=pages&action=profil&id=<?php echo $evenement->getId_utilisateur(); ?>">
              <?php echo $evenement->getNom()." ".$evenement->getPrenom(); ?>
            </a>
          </p>

          <div class="detail-grid">
            <div class="detail-info-card">
              <div class="detail-info-label">Date de début</div>
              <div class="detail-info-value"><?php echo date('d/m/Y', strtotime($evenement->getDate_debut_evenement())); ?></div>
            </div>
            <div class="detail-info-card">
              <div class="detail-info-label">Date de fin</div>
              <div class="detail-info-value"><?php echo date('d/m/Y', strtotime($evenement->getDate_fin_evenement())); ?></div>
            </div>
            <div class="detail-info-card">
              <div class="detail-info-label">Heure</div>
              <div class="detail-info-value"><?php echo $evenement->getHeure_evenement(); ?></div>
            </div>
            <div class="detail-info-card">
              <div class="detail-info-label">Lieu</div>
              <div class="detail-info-value">
                <?php echo $evenement->getAdresse(); ?><br>
                <?php echo $evenement->getNom_ville(); ?> <?php echo $evenement->getCode_postal(); ?>
              </div>
            </div>
          </div>

          <div class="detail-desc">
            <?php echo $evenement->getDescription(); ?>
          </div>

          <div class="detail-actions">
            <?php if(isset($_SESSION["id"])){
                  if($_SESSION["id"] === $evenement->getId_utilisateur()): ?>
                    <a class="btn-csv-detail" href="?controller=evenement&action=exportCsv&id=<?= $evenement->getId_evenement() ?>">
                      <i class="bi bi-download me-1"></i>Exporter en CSV
                    </a>
            <?php endif; 
            }?>

            <form action="?controller=participant&action=participer" method="POST" style="margin:0">
              <?php if(isset($_SESSION["id"])){ ?>
                    <input type="hidden" name="id_utilisateur" value="<?php
                   echo $_SESSION['id']; ?>">
              <?php } ?>
              <input type="hidden" name="id_evenement" value="<?php echo $evenement->getId_evenement(); ?>">
              <button type="submit" class="btn-participer">
                <i class="bi bi-person-plus me-1"></i>Participer
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-4">
      <div class="participants-card">
        <div class="participants-header">
          <h2 class="participants-title">Participants</h2>
          <span class="participants-count">
            <?php echo $evenement->getNb_participants(); ?>
            <?php echo $evenement->getNb_participants() > 1 ? 'participants' : 'participant'; ?>
          </span>
        </div>
        
      </div>
    </div>

  </div>
</div>