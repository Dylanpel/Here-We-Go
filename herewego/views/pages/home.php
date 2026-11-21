
<div class="back-home">
  <div class="texte-intro">
  </div>
  
</div>
<div class="search-bar">
    <form action="?controller=evenement&action=recherche" method="POST">
 
        <div class="search-fields">
 
            <input
                class="search-input search-input--wide"
                type="text"
                name="recherche"
                placeholder="Rechercher un événement…"
            >
 
            <div class="search-date-range">
                <label>Du
                    <input class="search-input" type="date" name="date_debut">
                </label>
                <span class="search-sep">→</span>
                <label>Au
                    <input class="search-input" type="date" name="date_fin">
                </label>
            </div>
 
            <input
                class="search-input"
                type="text"
                name="departement"
                placeholder="Dép. (ex: 76)"
                style="max-width: 130px;"
            >
 
            <button class="search-btn" type="submit">Rechercher</button>
 
        </div>
 
    </form>
</div>


    <div class="couleur-deux pt-5">
      <div class="container py-4 ">
        <div class="mb-4">
          <div class="row row-cols-3 row-cols-md-6 d-none d-sm-flex g-3 lien-cate">
            <div class="col d-flex justify-content-center">
              <a href="?controller=evenement&action=page_categorie&categorie=musique">
                <div class="category-btn">
                  <div class="cat-icon"><i class="bi bi-music-note-beamed" ></i></div>
                  <span class="cat-label">Musique</span>
                </div>
              </a>
            </div>
            <div class="col d-flex justify-content-center">
              <a href="?controller=evenement&action=page_categorie&categorie=culture">
                <div class="category-btn">
                  <div class="cat-icon"><i class="bi bi-book"></i></div>
                  <span class="cat-label">Culture</span>
                </div>
              </a> 
            </div>
            <div class="col d-flex justify-content-center">
              <a href="?controller=evenement&action=page_categorie&categorie=Technologie">
                <div class="category-btn">
                  <div class="cat-icon"><i class="bi bi-gear"></i></div>
                  <span class="cat-label">Thecnologie</span>
                </div>
              </a>
            </div>
            <div class="col d-flex justify-content-center">
              <a href="?controller=evenement&action=page_categorie&categorie=art">
                <div class="category-btn">
                  <div class="cat-icon"><i class="bi bi-brush"></i></div>
                  <span class="cat-label">Art</span>
                </div>
              </a>
            </div>
            <div class="col d-flex justify-content-center">
              <a href="?controller=evenement&action=page_categorie&categorie=cinema">
                <div class="category-btn">
                  <div class="cat-icon"><i class="bi bi-camera-reels"></i></div>
                  <span class="cat-label">Cinéma</span>
                </div>
              </a>
            </div>
            <div class="col d-flex justify-content-center">
              <a href="?controller=evenement&action=page_categorie&categorie=loisir">
                <div class="category-btn">
                  <div class="cat-icon"><i class="bi bi-balloon-heart" ></i></div>
                  <span class="cat-label">Loisirs</span>
                </div>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- CARD -->
    <div class="couleur-deux">
      <div class="container pt-2 pb-4 ">
      <h2>EVENEMENTS</h2>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-4 g-4">
            <?php
            foreach($evenement as $info){ ?>
                <div class="col carte">
                  <a href="?controller=evenement&action=page_evenement&id=<?php echo $info->getId_evenement(); ?>">
                    <div class="card event-card-deux h-100">
                      <img src="https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=600&q=80" class="card-img-top" style="height: 180px; object-fit: cover;" alt="Concert"/>
                      <div class="card-body d-flex flex-column">
                        <span class="event-tag"></span>
                        <h5 class="card-title mt-1"><?php echo $info->getLibelle(); ?></h5>
                        <p class="card-text flex-grow-1" style="-webkit-line-clamp: 3;"><?php echo $info->getDescription(); ?></p>
                        <div class="event-meta mt-auto">
                          <span><i class="bi bi-calendar3"></i> <?php echo date('d/m/Y', strtotime($info->getDate_debut_evenement())); ?></span>
                          <span class="ms-2"><i class="bi bi-geo-alt"></i><?php echo $info->getNom_ville(); ?></span>
                        </div>
                      </div>
                    </div>
                  </a>
                </div>
            <?php } ?>
        </div>
      </div>
    </div>

    <div class="couleur-deux">
      <div class="container py-4 ">
      <h2>MUSIQUE</h2>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-4 g-4">
            <?php
            foreach($musique as $info){ ?>
                <div class="col carte">
                  <a href="?controller=evenement&action=page_evenement&id=<?php echo $info->getId_evenement(); ?>">
                    <div class="card event-card-deux h-100">
                      <img src="https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=600&q=80" class="card-img-top" style="height: 180px; object-fit: cover;" alt="Concert"/>
                      <div class="card-body d-flex flex-column">
                        <span class="event-tag"></span>
                        <h5 class="card-title mt-1"><?php echo $info->getLibelle(); ?></h5>
                        <p class="card-text flex-grow-1" style="-webkit-line-clamp: 3;"><?php echo $info->getDescription(); ?></p>
                        <div class="event-meta mt-auto">
                          <span><i class="bi bi-calendar3"></i> <?php echo date('d/m/Y', strtotime($info->getDate_debut_evenement())); ?></span>
                          <span class="ms-2"><i class="bi bi-geo-alt"></i><?php echo $info->getNom_ville(); ?></span>
                        </div>
                      </div>
                    </div>
                  </a>
                </div>
            <?php } ?>
        </div>
      </div>
    </div>

    <div class="couleur-deux">
      <div class="container py-4 ">
        <h2>CULTURE</h2>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-4 g-4">
            <?php
            foreach($culture as $info){ ?>
                <div class="col carte">
                  <a href="?controller=evenement&action=page_evenement&id=<?php echo $info->getId_evenement(); ?>">
                    <div class="card event-card-deux h-100">
                      <img src="https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=600&q=80" class="card-img-top" style="height: 180px; object-fit: cover;" alt="Concert"/>
                      <div class="card-body d-flex flex-column">
                        <span class="event-tag"></span>
                        <h5 class="card-title mt-1"><?php echo $info->getLibelle(); ?></h5>
                        <p class="card-text flex-grow-1" style="-webkit-line-clamp: 3;"><?php echo $info->getDescription(); ?></p>
                        <div class="event-meta mt-auto">
                          <span><i class="bi bi-calendar3"></i> <?php echo date('d/m/Y', strtotime($info->getDate_debut_evenement())); ?></span>
                          <span class="ms-2"><i class="bi bi-geo-alt"></i><?php echo $info->getNom_ville(); ?></span>
                        </div>
                      </div>
                    </div>
                  </a>
                </div>
            <?php } ?>
        </div>
      </div>

    <div class="couleur-deux">
      <div class="container py-4 ">
      <h2>LOISIR</h2>
      <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-4 g-4">
          <?php
          foreach($loisir as $info){ ?>
              <div class="col carte">
                <a href="?controller=evenement&action=page_evenement&id=<?php echo $info->getId_evenement(); ?>">
                  <div class="card event-card-deux h-100">
                    <img src="https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=600&q=80" class="card-img-top" style="height: 180px; object-fit: cover;" alt="Concert"/>
                    <div class="card-body d-flex flex-column">
                      <span class="event-tag"></span>
                      <h5 class="card-title mt-1"><?php echo $info->getLibelle(); ?></h5>
                      <p class="card-text flex-grow-1" style="-webkit-line-clamp: 3;"><?php echo $info->getDescription(); ?></p>
                      <div class="event-meta mt-auto">
                        <span><i class="bi bi-calendar3"></i> <?php echo date('d/m/Y', strtotime($info->getDate_debut_evenement())); ?></span>
                        <span class="ms-2"><i class="bi bi-geo-alt"></i><?php echo $info->getNom_ville(); ?></span>
                      </div>
                    </div>
                  </div>
                </a>
              </div>
          <?php } ?>
        </div>
    </div>
