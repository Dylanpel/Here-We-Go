<?php 
require_once("models/ManagerNotification.php");
$notifications = ManagerNotification::getByUtilisateur($_SESSION["id"]);
if(!empty($notifications)) { ?>
 
<div class="dash-notif-list">
    <h3 class="dash-section-title"> Notifications</h3>
    <?php foreach($notifications as $notif) { ?>
        <div class="dash-notif <?php echo $notif['lu'] == 0 ? 'is-unread' : ''; ?>">
            <div class="dash-notif-content">
                <p class="dash-notif-message"><?php echo htmlspecialchars($notif['message']); ?></p>
                <small class="dash-notif-date"><?php echo htmlspecialchars($notif['date_creation']); ?></small>
            </div>
            <a class="dash-notif-delete" href="?controller=notification&action=delete&id=<?php echo (int)$notif['id_notification']; ?>" title="Supprimer">🗑️</a>
        </div>
    <?php } ?>
</div>
 
<?php } ?>
 
 

<h2 class="dash-section-title">Mes covoiturages créés</h2>
 
<?php 
require_once("models/ManagerParticiper.php");
foreach($covoiturage as $info) { ?>
 
<div class="dash-card">
 
    <div class="dash-card-header">
        <div>
            <p class="dash-card-event"><?php echo htmlspecialchars($info->getLibelle()); ?></p>
            <span class="dash-badge dash-badge--seats">💺 <?php echo (int)$info->getPlacesRestantes(); ?> place(s) restante(s)</span>
        </div>
        <a class="dash-btn dash-btn--outline" href="?controller=evenement&action=page_evenement&id=<?php echo (int)$info->getId_evenement(); ?>">
            Voir l'événement →
        </a>
    </div>
 
    <?php $demandes = ManagerParticiper::getDemandesByCovoiturage($info->getId_covoiturage()); ?>
    <?php if(!empty($demandes)) { ?>
        <div class="dash-block">
            <p class="dash-block-title">⏳ Demandes en attente</p>
            <div class="dash-demandes">
                <?php foreach($demandes as $demande) { ?>
                <div class="dash-demande">
                    <span class="dash-demande-info">👤 <strong><?php echo htmlspecialchars($demande['pseudo']); ?></strong> — <?php echo (int)$demande['quantite']; ?> place(s)</span>
                    <div class="dash-demande-actions">
                        <a class="dash-btn dash-btn--accept" href="?controller=participer&action=validerDemande&id_utilisateur=<?php echo (int)$demande['id_utilisateur']; ?>&id_covoiturage=<?php echo (int)$info->getId_covoiturage(); ?>&statut=accepte">✅ Accepter</a>
                        <a class="dash-btn dash-btn--refuse" href="?controller=participer&action=validerDemande&id_utilisateur=<?php echo (int)$demande['id_utilisateur']; ?>&id_covoiturage=<?php echo (int)$info->getId_covoiturage(); ?>&statut=refuse">❌ Refuser</a>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    <?php } ?>
 
    <?php $participants = ManagerParticiper::getParticipantsByCovoiturage($info->getId_covoiturage()); ?>
    <?php if(!empty($participants)) { ?>
        <div class="dash-block">
            <p class="dash-block-title">👥 Participants confirmés</p>
            <div class="dash-participants">
                <?php foreach($participants as $participant) { ?>
                <a class="dash-participant" href="?controller=pages&action=profil&id=<?php echo (int)$participant['id_utilisateur']; ?>">
                    <span class="dash-participant-avatar"><?php echo strtoupper(substr($participant['pseudo'], 0, 1)); ?></span>
                    <span><?php echo htmlspecialchars($participant['pseudo']); ?></span>
                    <span class="dash-participant-seats"><?php echo (int)$participant['quantite']; ?> place(s)</span>
                </a>
                <?php } ?>
            </div>
        </div>
    <?php } ?>
 
</div>
 
<?php } ?>

<h2 class="dash-section-title">🎟️ Covoiturages rejoints</h2>
 
<?php if(empty($covoiturages_rejoints)) { ?>
    <p class="dash-empty">Tu n'as rejoint aucun covoiturage pour le moment.</p>
<?php } else { ?>
    <div class="dash-rejoints-grid">
        <?php foreach($covoiturages_rejoints as $covoit) {
 
            $statut_label = match($covoit['statut']) {
                'en_attente' => ['⏳', 'En attente', 'waiting'],
                'accepte'    => ['✅', 'Accepté',    'accepted'],
                'refuse'     => ['❌', 'Refusé',     'refused'],
                default      => ['', $covoit['statut'], '']
            };
        ?>
        <div class="dash-rejoint dash-rejoint--<?php echo $statut_label[2]; ?>">
 
            <div class="dash-rejoint-header">
                <span class="dash-rejoint-event">🎪 <?php echo htmlspecialchars($covoit['libelle']); ?></span>
                <span class="dash-statut dash-statut--<?php echo $statut_label[2]; ?>"><?php echo $statut_label[0].' '.$statut_label[1]; ?></span>
            </div>
 
            <div class="dash-rejoint-details">
                <span><?php echo htmlspecialchars($covoit['vehicule']); ?></span>
                <span><?php echo (int)$covoit['quantite']; ?> réservée(s)</span>
                <span><?php echo (int)$covoit['places_restantes']; ?> restante(s)</span>
                <span><?php echo htmlspecialchars($covoit['montant']); ?> €</span>
            </div>
 
            <?php if($covoit['statut'] == 'refuse') { ?>
                <a class="dash-btn dash-btn--delete" href="?controller=participer&action=supprimerDemande&id_covoiturage=<?php echo (int)$covoit['id_covoiturage']; ?>">
                    🗑️ Supprimer la demande
                </a>
            <?php } ?>
 
        </div>
        <?php } ?>
    </div>
<?php } ?>
 