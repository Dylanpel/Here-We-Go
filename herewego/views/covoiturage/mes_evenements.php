<?php if(empty($evenements)){ ?>
 
<div class="covoit-empty-global">

    <p>Tu ne participes à aucun événement pour le moment.</p>
</div>
 
<?php } else { ?>
 
<?php 
$evenements_grouped = [];
foreach($evenements as $row) {
    $evenements_grouped[$row['id_evenement']]['libelle'] = $row['libelle'];
    if($row['id_covoiturage']) {
        $evenements_grouped[$row['id_evenement']]['covoiturages'][] = $row;
    }
}
?>
 
<div class="covoit-grid">
 
    <?php foreach($evenements_grouped as $id => $evenement) { ?>
 
    <div class="covoit-card">
        <div class="covoit-card-header">
            <h2 class="covoit-title"><?php echo htmlspecialchars($evenement['libelle']); ?></h2>
        </div>
 
        <div class="covoit-card-body">
 
            <?php if(empty($evenement['covoiturages'])) { ?>
 
                <p class="covoit-empty">Aucun covoiturage disponible pour cet événement.</p>
 
            <?php } else { ?>
 
                <div class="covoit-rides">
                    <?php foreach($evenement['covoiturages'] as $covoit) { ?>
 
                    <div class="covoit-ride <?php echo $covoit['places_restantes'] <= 0 ? 'is-full' : ''; ?>">
 
                        <div class="covoit-ride-meta">
                            <span class="covoit-vehicle">🚗 <?php echo htmlspecialchars($covoit['vehicule']); ?></span>
                            <?php if($covoit['places_restantes'] <= 0) { ?>
                                <span class="covoit-badge covoit-badge--full">0 place</span>
                            <?php } else { ?>
                                <span class="covoit-badge covoit-badge--available">🪑 <?php echo (int)$covoit['places_restantes']; ?> place<?php echo $covoit['places_restantes'] > 1 ? 's' : ''; ?></span>
                            <?php } ?>
                        </div>
 
                        <p class="covoit-driver">
                            Conducteur :
                            <a href="?controller=pages&action=profil&id=<?php echo (int)$covoit['id_utilisateur']; ?>">
                                <?php echo htmlspecialchars($covoit['pseudo']); ?>
                            </a>
                        </p>
 
                        <div class="covoit-ride-actions">
                            <?php if($covoit['places_restantes'] <= 0) { ?>
                                <span class="covoit-complet">Complet !</span>
                            <?php } else { ?>
                                <a class="covoit-btn" href="?controller=participer&action=formurejoindreCovoit&id_covoiturage=<?php echo (int)$covoit['id_covoiturage']; ?>">
                                    Rejoindre ce trajet
                                </a>
                            <?php } ?>
                        </div>
 
                    </div>
 
                    <?php } ?>
                </div>
 
            <?php } ?>
 
        </div>
    </div>
 
    <?php } ?>
 
</div>
 
<?php } ?>