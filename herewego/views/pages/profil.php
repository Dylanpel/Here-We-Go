<div class="container py-4">
  <div class="row g-4">

    <?php foreach ($profil as $info){ ?>

  
    <div class="col-lg-4 col-xl-3">

      <div class="profile-card mb-3">
        <div class="profile-header">
          <div class="profile-header">
            <div class="avatar-wrapper <?php echo $info->getCompteur_evenement() >= 10 ? 'avatar-vip' : ''; ?>">
            <?php if ($info->getAvatar_url()): ?>
              <img src="<?php echo $info->getAvatar_url(); ?>" alt="Photo de profil"/>
            <?php else: ?>
              <div class="avatar-placeholder"><i class="bi bi-person-fill"></i></div>
            <?php endif; ?>
          </div>
          </div>
          <div class="profile-name">
            <?php echo htmlspecialchars($info->getNom() . ' ' . $info->getPrenom()); ?>
          </div>
        </div>
        <div class="info-list">

          <div class="info-item">
            <div class="info-icon-box"><i class="bi bi-person"></i></div>
            <div>
              <div class="info-label">Pseudo</div>
              <div class="info-value"><?php echo htmlspecialchars($info->getPseudo()); ?></div>
            </div>
          </div>

          <div class="info-item">
            <div class="info-icon-box"><i class="bi bi-envelope"></i></div>
            <div>
              <div class="info-label">Email</div>
              <div class="info-value"><?php echo htmlspecialchars($info->getEmail()); ?></div>
            </div>
          </div>

          <div class="info-item">
            <div class="info-icon-box"><i class="bi bi-person-badge"></i></div>
            <div>
              <div class="info-label">Nom / Prénom</div>
              <div class="info-value">
                <?php echo htmlspecialchars($info->getNom() . ' ' . $info->getPrenom()); ?>
              </div>
            </div>
          </div>

          <div class="info-item">
            <div class="info-icon-box"><i class="bi bi-geo-alt"></i></div>
            <div>
              <div class="info-label">Adresse</div>
              <div class="info-value"><?php echo htmlspecialchars($info->getAdresse()); ?></div>
            </div>
          </div>

          <div class="info-item">
            <div class="info-icon-box"><i class="bi bi-telephone"></i></div>
            <div>
              <div class="info-label">Téléphone</div>
              <div class="info-value">
                <?php 
                  $tel = preg_replace('/\D/', '', $info->getNumeros_telephone());
                  echo htmlspecialchars(
                    preg_replace('/(\d{2})(?=\d)/', '$1 ',
                      strpos($tel, '33') === 0 ? '0' . substr($tel, 2) : $tel
                    )
                  );
                ?>
              </div>
            </div>
          </div>

        </div>
      </div>

      <div class="row g-2">
        <div class="col-12">
          <div class="stat-card">
            <div class="stat-value"><?php echo (int)$info->getCompteur_evenement(); ?></div>
            <div class="stat-label">
              <?php echo $info->getCompteur_evenement() > 1 ? 'Participations' : 'Participation'; ?>
            </div>
          </div>
        </div>


        <?php if(isset($_SESSION["id"]) && $_SESSION["id"] == $info->getId_utilisateur()) { ?>
        <div class="col-12 mt-2">
            <a href="?controller=user&action=page_modification&id=<?php echo $info->getId_utilisateur(); ?>">
                <button class="btn btn-new w-100">
                    <i class="bi bi-pencil me-1"></i>Modifier mon profil
                </button>
            </a>
        </div>
        <?php } ?>

      </div>

    </div>
    <?php } ?>


    <div class="col-lg-8 col-xl-9">


        <div class="d-flex align-items-center justify-content-between mb-3">
          <h2 class="section-title mb-0">Mes événements</h2>
          <div class="d-flex gap-2">
              <a href="?controller=evenement&action=insert">
                  <button class="btn btn-new">
                      <i class="bi bi-plus-lg me-1"></i>Nouvel événement
                  </button>
              </a>
              <a href="?controller=evenement&action=exportCsvAll">
                  <button class="btn btn-outline-secondary">
                      <i class="bi bi-download me-1"></i>Exporter mes événements
                  </button>
              </a>
          </div>
        </div>

        <div class="row g-3 mb-4 carte">
          <?php foreach($profil_event as $info) { ?>
          <div class="col-lg-6 col-xl-4">
              <a href="?controller=evenement&action=page_evenement&id=<?php echo $info->getId_evenement(); ?>">
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
                  </div>
                </div>
              </div>
              </a>
            </div>
          <?php } ?>
        </div>


        <div class="d-flex align-items-center justify-content-between mb-3">
            <h2 class="section-title mt-4">🔗 Intégrer HereWeGo sur votre site</h2>
        </div>
        <div class="row g-3 mb-4">
            <?php foreach($profil_event as $info) { 
                $url = 'http://localhost/git/Projet-Fil-rouge-Here-We-GO/herewego/?controller=evenement&action=page_evenement&id=' . $info->getId_evenement();
                $img = 'http://localhost/git/Projet-Fil-rouge-Here-We-GO/herewego/asset/image/logomarron.png';
                $code = '<a href="' . $url . '" target="_blank"><img src="' . $img . '" alt="Covoiturage avec HereWeGo" width="150"></a>';
            ?>
            <div class="col-12">
                <div class="event-card p-3">
                    <p><strong><?php echo $info->getLibelle(); ?></strong></p>
                    <p>Copiez ce code sur votre site :</p>
                    <textarea onclick="this.select();" readonly rows="5" style="width:100%; font-size:0.8rem;"><?php echo htmlspecialchars($code); ?></textarea>
                </div>
            </div>
            <?php } ?>
        </div>

   
        <div class="d-flex align-items-center justify-content-between mb-3">
          <h2 class="section-title participation mt-5">Mes participations</h2>
        </div>

        <div class="row g-3 carte">
          <?php foreach($profil_participe as $info) { ?>
          <div class="col-lg-6 col-xl-4">
              <a href="?controller=evenement&action=page_evenement&id=<?php echo $info->getId_evenement(); ?>">
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
                  </div>
                </div>
              </div>
              </a>
            </div>
          <?php } ?>
        </div>

    </div>
  </div>
</div>