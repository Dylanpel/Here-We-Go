<div class="content">
    <div class="card-wrapper">
        <div class="form-card form-input">
        <form action="?controller=user&action=update" method="POST">
            <input type="hidden" name="id_utilisateur" value="<?php echo $utilisateur->getId_utilisateur(); ?>">
            <div class="row g-3">
                <div class="col-6">
                    <label class="form-label">Nom <span class="required">*</span></label>
                    <input type="text" class="form-control" name="nom" value="<?php echo $utilisateur->getNom(); ?>" placeholder="<?php echo $utilisateur->getNom(); ?>"/>
                </div>
                <div class="col-6">
                    <label class="form-label">Prénom <span class="required">*</span></label>
                    <input type="text" class="form-control" name="prenom" value="<?php echo $utilisateur->getPrenom(); ?>" placeholder="<?php echo $utilisateur->getPrenom(); ?>"/>
                </div>
            </div>
            <div class="mb-3 mt-3">
                <label class="form-label">Pseudo <span class="required">*</span></label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-at"></i></span>
                    <input type="text" class="form-control" name="pseudo" value="<?php echo $utilisateur->getPseudo(); ?>" placeholder="<?php echo $utilisateur->getPseudo(); ?>"/>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Photo de profil</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-image"></i></span>
                    <input type="url" class="form-control" name="image_url" value="<?php echo $utilisateur->getAvatar_url(); ?>"/>
                </div>
            </div>
            <div class="row g-3">
                <div class="col-6">
                    <label class="form-label">Date de naissance <span class="required">*</span></label>
                    <input type="date" class="form-control" name="date_de_naissance" value="<?php echo $utilisateur->getDate_de_naissance(); ?>" placeholder="<?php echo $utilisateur->getDate_de_naissance(); ?>"/>
                </div>
                <div class="col-6">
                    <label class="form-label">Téléphone</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-phone"></i></span>
                        <input type="tel" class="form-control" name="numeros_telephone" value="<?php echo $utilisateur->getNumeros_telephone(); ?>" placeholder="<?php echo $utilisateur->getNumeros_telephone(); ?>"/>
                    </div>
                </div>
            </div>
            <div class="mb-3 mt-3">
                <label class="form-label">Email <span class="required">*</span></label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                    <input type="email" class="form-control" name="email" value="<?php echo $utilisateur->getEmail(); ?>" placeholder="<?php echo $utilisateur->getEmail(); ?>"/>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Adresse</label>
                <input type="text" class="form-control" name="adresse" value="<?php echo $utilisateur->getAdresse(); ?>" placeholder="<?php echo $utilisateur->getAdresse(); ?>"/>
            </div>
            <div class="row g-3">
                <div class="col-5">
                    <label class="form-label">Code postal</label>
                    <input type="text" class="form-control" name="codepostal" id="monInput" value="<?php echo $utilisateur->getCode_postal(); ?>" placeholder="<?php echo $utilisateur->getCode_postal(); ?>">
                </div>
                <div class="col-7">
                    <label class="form-label">Ville <small class="text-muted">(actuelle : <?php echo $utilisateur->getNom_ville(); ?>)</small></label>
                    <input type="text" class="form-control" name="ville" id="villeInput" value="<?php echo $utilisateur->getNom_ville(); ?>" placeholder="<?php echo $utilisateur->getNom_ville(); ?>">
                </div>
                <div class="col-12">
                    <label class="form-label">Département</label>
                    <input type="text" class="form-control" name="departement" id="departementInput" value="<?php echo $utilisateur->getDepartement(); ?>" placeholder="<?php echo $utilisateur->getDepartement(); ?>">
                </div>
                <ul class="list-group api" id="result"></ul>
                <input type="hidden" name="id_ville" id="id_ville" value="<?php echo $utilisateur->getId_ville(); ?>">
            </div>

            <?php if(isset($_SESSION["role"]) && $_SESSION["role"] === "Administrateur") { ?>
                <div class="mb-3 mt-3">
                    <label class="form-label">Rôle</label>
                    <select class="form-control" name="id_role">
                        <option value="1" <?php echo $utilisateur->getId_role() == 1 ? 'selected' : ''; ?>>Administrateur</option>
                        <option value="2" <?php echo $utilisateur->getId_role() == 2 ? 'selected' : ''; ?>>Utilisateur</option>
                        <option value="3" <?php echo $utilisateur->getId_role() == 3 ? 'selected' : ''; ?>>Organisateur</option>
                        <option value="4" <?php echo $utilisateur->getId_role() == 4 ? 'selected' : ''; ?>>Covoitureur</option>
                        <option value="5" <?php echo $utilisateur->getId_role() == 5 ? 'selected' : ''; ?>>Participant</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Statut</label>
                    <select class="form-control" name="statut">
                        <option value="en_attente" <?php echo $utilisateur->getStatut() == 'en_attente' ? 'selected' : ''; ?>>En attente</option>
                        <option value="actif" <?php echo $utilisateur->getStatut() == 'actif' ? 'selected' : ''; ?>>Actif</option>
                        <option value="refuse" <?php echo $utilisateur->getStatut() == 'refuse' ? 'selected' : ''; ?>>Refusé</option>
                    </select>
                </div>
            <?php } else { ?>
                <input type="hidden" name="id_role" value="<?php echo $utilisateur->getId_role(); ?>">
                <input type="hidden" name="statut" value="<?php echo $utilisateur->getStatut(); ?>">
            <?php } ?>
            <div class="mb-3 mt-3">
    <label class="form-label">Nouveau mot de passe <small class="text-muted">(laisser vide pour ne pas changer)</small></label>
    <div class="input-group">
        <span class="input-group-text"><i class="bi bi-lock"></i></span>
        <input type="password" class="form-control" name="password" placeholder="Nouveau mot de passe"/>
    </div>
</div>
<div class="mb-3">
    <label class="form-label">Confirmer le nouveau mot de passe</label>
    <div class="input-group">
        <span class="input-group-text"><i class="bi bi-lock"></i></span>
        <input type="password" class="form-control" name="password_confirm" placeholder="Confirmer le mot de passe"/>
    </div>
</div>
            <input class="btn-submit mt-3" type="submit" value="Modifier">
        </form>
        </div>
    </div>
</div>