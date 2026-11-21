<div class="container py-5" style="max-width: 740px;">
  <div class="form-card">
 
    <div class="form-header">
      <div class="form-header-icon">
        <i class="bi bi-car-front"></i>
      </div>
      <div class="form-header-text">
        <p>Formulaire d'ajout</p>
        <h2>Proposer un covoiturage</h2>
      </div>
    </div>
 
    <form action="?controller=covoiturage&action=ajouter" method="POST" autocomplete="off">
 
      <div class="form-body">
 
  
        <div class="sec-label"><i class="bi bi-calendar-event"></i>Événement lié</div>
 
        <div class="mb-3">
          <label for="id_evenement" class="form-label">Événement concerné</label>
          <select name="id_evenement" id="id_evenement" class="form-select">
            <option value="">— Choisir un événement —</option>
            <?php foreach($evenement as $event){ ?>
              <option value="<?php echo $event->getId_evenement(); ?>">
                <?php echo $event->getLibelle(); ?>
              </option>
            <?php } ?>
        
          </select>
        </div>
 
  
        <div class="sec-label"><i class="bi bi-car-front-fill"></i>Véhicule</div>
 
        <div class="row g-3 mb-3">
          <div class="col-md-8">
            <label for="vehicule" class="form-label">Modèle du véhicule</label>
            <div class="input-group">
              <span class="input-group-text"><i class="bi bi-truck"></i></span>
              <input type="text" class="form-control" id="vehicule" name="vehicule"
                     placeholder="Ex : Renault Clio, Peugeot 308…">
            </div>
          </div>
          <div class="col-md-4">
            <label for="nombre_place_dispo" class="form-label">Nombre de places</label>
            <input type="number" class="form-control" id="nombre_place_dispo"
                   name="nombre_place_dispo" placeholder="Ex : 3" min="1" max="8">
          </div>
        </div>
 
        <div class="mb-3">
          <label for="media_url_voiture" class="form-label">Photo du véhicule</label>
          <div class="input-group">
            <span class="input-group-text"><i class="bi bi-link-45deg"></i></span>
            <input type="url" class="form-control" id="media_url_voiture"
                   name="media_url_voiture" placeholder="https://…">
          </div>
        </div>
 
     
        <div class="sec-label"><i class="bi bi-currency-euro"></i>Tarif &amp; description</div>
 
        <div class="mb-3">
          <label for="montant" class="form-label">Participation aux frais</label>
          <div class="input-group">
            <span class="input-group-text"><i class="bi bi-wallet2"></i></span>
            <input type="number" class="form-control suffix-input" id="montant" name="montant"
                   placeholder="0.00" min="0" step="0.50">
            <span class="input-suffix">€ / pers.</span>
          </div>
        </div>
 
        <div class="mb-3">
          <label for="description" class="form-label">Description</label>
          <textarea class="form-control" id="description" name="description"
                    placeholder="Point de départ, horaires, bagages acceptés…"></textarea>
        </div>
 
      </div>
 
   
      <input type="hidden" name="id_utilisateur" value="<?php echo $_SESSION['id']; ?>">
 

      <div class="form-footer">
        <button type="submit" class="btn-submit-custom">
          <i class="bi bi-check2-circle me-1"></i>Publier le trajet
        </button>
      </div>
 
    </form>
  </div>
</div>
 


