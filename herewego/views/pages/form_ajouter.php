<?php if(!empty($error)) { ?>
    <div class="alert alert-danger">
        <ul>
            <?php foreach($error as $err) { ?>
                <li><?php echo $err; ?></li>
            <?php } ?>
        </ul>
    </div>
<?php } ?>
<div class="container py-5" style="max-width: 740px;">
  <div class="form-card">
 
    <div class="form-header">
      <div class="form-header-icon">
        <i class="bi bi-calendar-plus"></i>
      </div>
      <div class="form-header-text">
        <p>Formulaire d'ajout</p>
        <h2>Créer un événement</h2>
      </div>
    </div>
 
    <form action="?controller=evenement&action=ajouter" method="POST" autocomplete="off">
 
      <div class="form-body">
 
        <div class="sec-label"><i class="bi bi-info-circle"></i>Informations générales</div>
 
        <div class="mb-3">
          <label for="titre" class="form-label">Titre de l'événement</label>
          <input type="text" class="form-control" id="titre" name="titre" placeholder="Ex : Festival de Jazz de Rouen">
        </div>
 
        <div class="row g-3 mb-3">
          <div class="col-md-6">
            <label for="categorie" class="form-label">Catégorie</label>
            <select name="categorie" id="categorie" class="form-select">
              <option value="">— Choisir une catégorie —</option>
              <?php foreach($categories as $categorie): ?>
                <option value="<?= $categorie['id_categorie'] ?>">
                  <?= htmlspecialchars($categorie['libelle']) ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="col-md-6">
            <label for="url_media" class="form-label">URL du média</label>
            <div class="input-group">
              <span class="input-group-text"><i class="bi bi-link-45deg"></i></span>
              <input type="url" class="form-control" id="url_media" name="url_media" placeholder="https://...">
            </div>
          </div>
        </div>
 
        <div class="mb-3">
          <label for="description" class="form-label">Description</label>
          <textarea class="form-control" id="description" name="description" placeholder="Décrivez votre événement..."></textarea>
        </div>
 

        <div class="sec-label"><i class="bi bi-clock"></i>Date &amp; heure</div>
 
        <div class="row g-3 mb-3">
          <div class="col-md-4">
            <label for="date_debut_evenement" class="form-label">Date de début</label>
            <input type="date" class="form-control" id="date_debut_evenement" name="date_debut_evenement">
          </div>
          <div class="col-md-4">
            <label for="date_fin_evenement" class="form-label">Date de fin</label>
            <input type="date" class="form-control" id="date_fin_evenement" name="date_fin_evenement">
          </div>
          <div class="col-md-4">
            <label for="heure_evenement" class="form-label">Heure</label>
            <input type="time" class="form-control" id="heure_evenement" name="heure_evenement">
          </div>
        </div>
 

        <div class="sec-label"><i class="bi bi-geo-alt"></i>Localisation</div>
 
        <div class="mb-3">
          <label for="adresse" class="form-label">Adresse</label>
          <div class="input-group">
            <span class="input-group-text"><i class="bi bi-house-door"></i></span>
            <input type="text" class="form-control" id="adresse" name="adresse" placeholder="Numéro et nom de rue">
          </div>
        </div>
 
        <div class="row g-3 mb-3">
          <div class="col-md-4">
            <label for="monInput" class="form-label">Code postal</label>
            <input type="text" class="form-control" id="monInput" name="codepostal" placeholder="76000">
          </div>
          <div class="col-md-4">
            <label for="villeInput" class="form-label">Ville</label>
            <input type="text" class="form-control" id="villeInput" name="ville" placeholder="Rouen">
          </div>
          <div class="col-md-4">
            <label for="departementInput" class="form-label">Département</label>
            <input type="text" class="form-control" id="departementInput" name="departement" placeholder="Seine-Maritime">
          </div>
        </div>
 
        <div class="result" id="result"></div>
 

 

      <input type="hidden" name="id_ville" id="id_ville">
      <input type="hidden" name="id_utilisateur" value="<?php echo $_SESSION['id']; ?>">
 

      <div class="form-footer">
        <button type="submit" class="btn-submit-custom">
          <i class="bi bi-check2-circle me-1"></i>Publier l'événement
        </button>
      </div>
 
    </form>
  </div>
 
</div>
