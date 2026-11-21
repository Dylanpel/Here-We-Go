<div class="content">
    <div class="card-wrapper">
        <div class="form-card form-input">
        <form action="?controller=user&action=inscrire" onsubmit="return verification()" method="POST">
            <div class="row g-3">
                <div class="col-6">
                <label class="form-label">Nom <span class="required">*</span></label>
                <input type="text" class="form-control" name="nom" placeholder="Dupont" id="nom"/>
                </div>
                <div class="col-6">
                <label class="form-label">Prénom <span class="required">*</span></label>
                <input type="text" class="form-control" name="prenom" placeholder="Jean" id="prenom"/>
                </div>
            </div>
            <div class="mb-3 mt-3">
                <label class="form-label">Pseudo <span class="required">*</span></label>
                <div class="input-group">
                <span class="input-group-text"><i class="bi bi-at"></i></span>
                <input type="text" class="form-control" name="pseudo" placeholder="jean_dupont"/>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Photo de profil</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-image"></i></span>
                    <input type="url" class="form-control" name="image_url"/>
                </div>
            </div>
                <div class="row g-3">
                    <div class="col-6">
                        <label class="form-label">Date de naissance <span class="required">*</span></label>
                        <input type="date" class="form-control" name="date_naissance" id="date"/>
                    </div>
                    <div class="col-6">
                        <label class="form-label">Téléphone</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-phone"></i></span>
                            <input type="tel" class="form-control" name="numeros_telephone" class="numeros_telephone" placeholder="06 12 34 56 78"/>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Email <span class="required">*</span></label>
                    <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                    <input type="email" class="form-control" name="email" placeholder="jean@exemple.fr" id="mail"/>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Mot de passe <span class="required">*</span></label>
                    <div class="pw-wrap">
                        <input type="password" class="form-control" name="password" placeholder="8 caractères minimum" id="mdp"/>
                        <button class="toggle-pw" type="button" onclick="togglePw('mdp', this)">
                        <i class="bi bi-eye"></i>
                        </button>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Confirmer le mot de passe <span class="required">*</span></label>
                    <div class="pw-wrap">
                        <input type="password" class="form-control" placeholder="Répétez votre mot de passe" id="mdp2"/>
                        <button class="toggle-pw" type="button" onclick="togglePw('mdp2', this)">
                        <i class="bi bi-eye"></i>
                        </button>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Adresse</label>
                    <input type="text" class="form-control" name="adresse" placeholder="12 rue de la Paix"/>
                </div>
                <div class="row g-3">
                    <div class="col-5">
                    <label class="form-label">Code postal</label>
                        <input type="text" class="form-control" name="codepostal" id="monInput" placeholder="Code postal">
                    </div>
                    <div class="col-7">
                    <label class="form-label">Ville</label>
                        <input type="text" class="form-control" name="ville" id="villeInput" placeholder="Ville">
                    </div>
                    <input type="text" class="form-control" name="departement" id="departementInput" placeholder="departement">
                    <ul class="list-group api" id="result">
                    </ul>
                    <input type="HIDDEN" name="id_ville" id="id_ville">
                    <input type="hidden" name="id_role" value="2">
                    <input type="hidden" name="verouille" value="0">
                </div>
                <div class="mb-4 mt-1">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="cgu"/>
                    <label class="form-check-label" for="cgu">
                        J'accepte les <a href="#">Conditions d'utilisation</a> et la <a href="#">Politique de confidentialité</a> <span class="required">*</span>
                    </label>
                </div>
            </div>
            <div id="message"></div>
                <input class="btn-submit" type="submit" value="Creer mon compte">
            </div>
        </form>
    </div>
</div>
