<h2>Événements recommandés pour toi</h2>
<ul>
    <?php foreach($evenements as $evenement){ ?>
    <a href="?controller=evenement&action=page_evenement&id=<?php echo $evenement->getId_evenement(); ?>">
        <li>
            <?= $evenement->getLibelle() ?>
            <?= $evenement->getDate_debut_evenement() ?>
            <?= $evenement->getAdresse() ?>
        </li></a>
    <?php } ?>
</ul>