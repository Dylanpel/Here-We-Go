<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./asset/styles/bootstrap.css">
    <link rel="stylesheet" href="./asset/styles/styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <title>HereWego</title>
</head>
<body>
    <nav class="navbar-top">
        <div class="container-fluid px-4">
            <div class="d-flex align-items-center justify-content-between">
 
             
                <div class="d-flex align-items-center">
                    <?php if(isset($_SESSION["role"])){
                        if($_SESSION["role"]==="Administrateur"){
                          ?><a href="?controller=pages&action=index_admin">Admin</a> 
                          <span class="separator">·</span>
                          <a href="?controller=evenement&action=list">Liste des événement</a> 
                            <span class="separator">·</span>
                            <a href="?controller=user&action=list">Liste des utilisateurs</a> 
                            <span class="separator">·</span>
                            <a href="?controller=covoiturage&action=list">Liste des covoiturages</a> 
                            <span class="separator">·</span>
                          <?php }} ?>
                    
                    <?php
                        if(isset($_SESSION["user"])){ ?>
                            
                            <a href="?controller=evenement&action=insert">Ajouter un événement</a>
                            <span class="separator">·</span>
                            <a href="?controller=pages&action=profil">Profil</a>
                            <span class="separator">·</span>
                            <a href="?controller=user&action=deconecter">Se Deconnecter</a>
                            <span class="separator">·</span> <?php
                        }else {
                        ?>
                            <a href="?controller=user&action=page_connexion">Se connecter</a>
                            <span class="separator">·</span>
                            <a href="?controller=user&action=page_inscription">Inscription</a>
                            <?php } ?>
                </div>
            </div>
        </div>
    </nav>
    <nav class="navbar navbar-main navbar-expand-lg">
    <div class="container-fluid px-2">

     >
      <a class="navbar-brand" href="?controller=pages&action=home">
        <img src="./asset/image/logomarron.png" width="140px">
      </a>

    
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav" aria-controls="mainNav" aria-expanded="false" aria-label="Ouvrir le menu">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="mainNav">
        <ul class="navbar-nav me-auto">

            <li class="nav-item">
              <a class="nav-link active color-accueil" href="http://localhost/git/Projet-Fil-rouge-Here-We-GO/herewego/">Accueil</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active color-accueil" href="http://localhost/git/Projet-Fil-rouge-Here-We-GO/herewego/">C'est Quoi?</a>
            </li>

            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Evenements</a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="?controller=evenement&action=page_categorie&categorie=musique">Musique</a></li>
                <li><a class="dropdown-item" href="?controller=evenement&action=page_categorie&categorie=Culture">Culture</a></li>
                <li><a class="dropdown-item" href="?controller=evenement&action=page_categorie&categorie=Technologie">Technologie</a></li>
                <li><a class="dropdown-item" href="?controller=evenement&action=page_categorie&categorie=Art">Art</a></li>
                <li><a class="dropdown-item" href="?controller=evenement&action=page_categorie&categorie=Cinéma">Cinéma</a></li>
                <li><a class="dropdown-item" href="?controller=evenement&action=page_categorie&categorie=Loisir">Loisirs</a></li>
                <li><a class="dropdown-item" href="?controller=evenement&action=page_categorie&categorie=Sport">Sport</a></li>
                <li><a class="dropdown-item" href="?controller=evenement&action=page_categorie&categorie=Gastronomie">Gastronomie</a></li>
                <li><a class="dropdown-item" href="?controller=evenement&action=page_categorie&categorie=Festival">Festival</a></li>
                <li><a class="dropdown-item" href="?controller=evenement&action=page_categorie&categorie=Conference">Conférence</a></li>
              </ul>
            </li>

            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Covoiturage</a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">Covoiturer avec HereWeGo?</a></li>
                <li><a class="dropdown-item" href="?controller=participer&action=mesEvenements">Participer a un covoiturage</a></li>
                <li><a class="dropdown-item" href="http://localhost/git/Projet-Fil-rouge-Here-We-GO/herewego/?controller=covoiturage&action=insert">Proposer un covoiturage</a></li>
                <li><a class="dropdown-item" href="http://localhost/git/Projet-Fil-rouge-Here-We-GO/herewego/?controller=covoiturage&action=page_covoiturage">Mes covoiturage</a></li>
              </ul>
            </li>
        </ul>

        <?php 
        require_once("models/ManagerUser.php");
        if(isset($_SESSION["user"])){
          $jeu = ManagerUser::getCompteur($_SESSION["id"]); 
          if(isset($jeu["compteur_evenement"]) && $jeu["compteur_evenement"] >= 10){?>
            <div class="navbar-cta">
              <a href="?controller=pages&action=chance">
                <button class="boutton">
                  <i class="fas fa-ticket-alt"></i>
                  <span>J'ai de la chance</span>
                </button>
              </a>
            </div>
        
        <?php }} ?>

      <div class="d-flex align-items-center gap-3 pe-5 ps-5">


        <?php if(isset($_SESSION["id"])) { 
            require_once("models/ManagerNotification.php");
            $nb_notifs = ManagerNotification::countUnread($_SESSION["id"]);
        } ?>
        <a href="?controller=notification&action=index" style="position:relative; color:#E0C9A6;">
            <i class="bi bi-bell" style="font-size:1.5rem;"></i>
            <?php if(isset($nb_notifs) && $nb_notifs > 0) { ?>
                <span style="position:absolute; top:-5px; right:-8px; background:red; color:white; border-radius:50%; font-size:0.7rem; padding:2px 5px;">
                    <?php echo $nb_notifs; ?>
                </span>
            <?php } ?>
        </a>

  
        <div class="d-flex gap-3">
            <a href="https://www.facebook.com/?locale=fr_FR" aria-label="Facebook"><i class="bi bi-facebook" style="font-size:1.3rem; color:#E0C9A6"></i></a>
            <a href="https://www.instagram.com/" aria-label="Instagram"><i class="bi bi-instagram" style="font-size:1.3rem;color:#E0C9A6"></i></a>
            <a href="https://x.com/?lang=fr" aria-label="Twitter"><i class="bi bi-twitter-x" style="font-size:1.3rem;color:#E0C9A6"></i></a>
        </div>

      </div>

      </div>
    </div>
  </nav>
    <?php
   require_once("routes.php"); 
   ?>
   <footer class="text-light pt-5 pb-3 mt-5">
  <div class="container">

    <div class="row">

      <div class="col-md-4 mb-4">
        <a href="?controller=pages&action=home"><img src="./asset/image/logomarron.png" width="120px" class="mb-3"></a>
        <p>
          HereWeGo est une plateforme pour découvrir des événements et partager des trajets en covoiturage facilement.
        </p>
      </div>


      <div class="col-md-4 mb-4">
        <h5>Navigation</h5>
        <ul class="list-unstyled">
          <li><a href="#" class="text-decoration-none text-light">Accueil</a></li>
          <li><a href="#" class="text-decoration-none text-light">C'est quoi ?</a></li>
          <li><a href="?controller=evenement&action=list" class="text-decoration-none text-light">Événements</a></li>
          <li><a href="?controller=covoiturage&action=page_covoiturage" class="text-decoration-none text-light">Covoiturage</a></li>
        </ul>
      </div>

    
      <div class="col-md-4 mb-4">
        <h5>Contact</h5>
        <p>Email : contact@herewego.fr</p>

        <div class="d-flex gap-3 mt-3">
          <a href="#" class="text-light"><i class="bi bi-facebook fs-5"></i></a>
          <a href="#" class="text-light"><i class="bi bi-instagram fs-5"></i></a>
          <a href="#" class="text-light"><i class="bi bi-twitter-x fs-5"></i></a>
        </div>
      </div>

    </div>

    <hr class="border-light">


    <div class="text-center">
      <small>© 2026 HereWeGo - Tous droits réservés</small>
    </div>

  </div>
</footer>
    <script src="./asset/scripts/bootstrap.bundle.js"></script>
    <script src="./asset/scripts/script.js"></script>
</body>

</html>
