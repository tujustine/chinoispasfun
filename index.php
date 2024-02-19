<?php
  session_start();
  require_once("./connect_db.php");

  $sql = connexion();

  entete();

  echo '
  <!-- body -->
  <body id="body">';

    navbar();

    echo '
    <!-- contenu de la page -->
    <div id="content">

      <h1>Accueil</h1>
      <p class="p_texte">Bienvenue sur Chinois(Pas)Fun ! Tu es sur un site pour apprendre quelques bases du chinois. </p>    
      <p class="p_texte">Je te propose d’appuyer sur le bouton juste en dessous pour commencer l’aventure avec monsieur Xiao ! 加油 ！</p>
      <div id="container-img">
        <img src="./img/xiao.png" alt="Mr Xiao" id="img-xiao">
      </div>
      <div class="text-center">
        <!-- bouton pour accéder à la page d\'accueil des exercices-->
        <a href="./cours_exo_accueil.php" class="btn mb-4" id="accueil-btn"><b>C\'est parti pour l\'aventure !</b></a>
      </div>
    </div>';

    switch_theme();

    // on vérifie si un email est envoyé au serveur 
    // "email" correspond au name de l'input
    if($_POST['email']) {
      // on récupère la valeur associée 
      $mail = $_POST['email'];
      // vérifie si l'email existe déjà dans la base de données
      $check_query = $sql->prepare('SELECT mail FROM newsletter WHERE mail = :mail');
      $check_query->bindParam(':mail', $mail);
      $check_query->execute();

      if ($check_query->rowCount() == 0) {
          // l'email n'existe pas, insère l'e-mail dans la table newsletter
          $news_requete = $sql->prepare('INSERT INTO newsletter (id_newsletter, mail) VALUES (NULL, :mail)');
          $news_requete -> bindParam(':mail', $mail);
          $res_news = $news_requete->execute();
      } 
    }

    footer();
?>