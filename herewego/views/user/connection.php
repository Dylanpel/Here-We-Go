<div class="content">
    <div class="card-wrapper">
        <div class="form-card form-input">
            <div class="welcome-text">
                <h2>Se Connecter</h2>
                <p>Pas encore de compte ? <a href="?controller=user&action=page_inscription">S'inscrire gratuitement</a></p>
            </div>
            <form action="?controller=user&action=connection" method="POST">
                <div class="mb-3">
                    <label class="form-label">Adresse e-mail <span class="required">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                        <input type="email" class="form-control" id="login_mail" name="email" placeholder="jean@exemple.fr" autocomplete="email"/>
                    </div>
                </div>
                <div class="mb-1">
                    <label class="form-label">Mot de passe <span class="required">*</span></label>
                    <div class="pw-wrap">
                        <input type="password" class="form-control" id="login_mdp" name="password" placeholder="Votre mot de passe" autocomplete="current-password"/>
                        <button class="toggle-pw" type="button" onclick="togglePw()">
                        <i class="bi bi-eye" id="eye-icon"></i>
                        </button>
                    </div>
                </div>
                 <button class="btn-submit btn-co" type="submit">
                    <i class="bi bi-box-arrow-in-right me-2"></i>Se connecter
                </button>
            </form>
        </div>
    </div>
</div>