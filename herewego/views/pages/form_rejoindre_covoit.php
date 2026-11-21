<div class="join-wrapper">
 
    <div class="join-card">
 
        <div class="join-card-header">
            <div>
                <h2 class="join-title">Rejoindre le covoiturage</h2>
                <p class="join-subtitle">Indiquez le nombre de places souhaitées</p>
            </div>
        </div>
 
        <div class="join-card-body">
            <form action="?controller=participer&action=ajouter" method="POST">
 
                <input type="hidden" name="id_utilisateur" value="<?php echo (int)$_SESSION['id']; ?>">
                <input type="hidden" name="id_covoiturage" value="<?php echo (int)$_GET['id_covoiturage']; ?>">
 
                <div class="join-field">
                    <label class="join-label" for="quantite">Nombre de personnes</label>
                    <div class="join-input-row">
                        <input
                            class="join-input"
                            type="number"
                            id="quantite"
                            name="quantite"
                            min="1"
                            value="1"
                            required
                        >
                        <button class="join-btn" type="submit">
                            Valider ✓
                        </button>
                    </div>
                </div>
 
            </form>
        </div>
 
    </div>
 
</div>