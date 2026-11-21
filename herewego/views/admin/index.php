<?php if(isset($_SESSION["role"]) && $_SESSION["role"]==="Administrateur") { ?>

    <h2>Comptes en attente de validation</h2>
    <?php if(empty($utilisateurs_en_attente)) { ?>
        <p>Aucun compte en attente.</p>
    <?php } else { ?>
        <?php foreach($utilisateurs_en_attente as $user) { ?>
            <div>
                <p>👤 <?php echo $user['pseudo']; ?> — <?php echo $user['email']; ?></p>
                <a href="?controller=pages&action=validerCompte&id=<?php echo $user['id_utilisateur']; ?>&statut=actif">✅ Valider</a>
                <a href="?controller=pages&action=validerCompte&id=<?php echo $user['id_utilisateur']; ?>&statut=refuse">❌ Refuser</a>
            </div>
        <?php } ?>
    <?php } ?>
<?php } else { ?>
    <p>Vous n'êtes pas Administrateur</p>
<?php } ?>