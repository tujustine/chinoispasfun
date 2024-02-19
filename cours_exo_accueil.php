
<?php
    session_start();
    require_once("./connect_db.php");
    $sql = connexion();

    // sur cette page, nous n'affichons que les thèmes des exercices
    // distinct permet donc de n'afficher chaque thème qu'une seule fois
    $requete = $sql->prepare("SELECT DISTINCT theme FROM mot") ;
    $resultat = $requete->execute();

    // vérifie si un paramètre theme est présent dans la requête GET
    // si oui, on récupère la valeur et l'utilisateur est redirigé vers cours_exo.php
    if ($_GET['theme']) {
        $theme = $_GET['theme'];
        header("Location: cours_exo.php");
        exit();
    }
        
    entete();

    echo '
        <!-- body -->
        <body id="body">';
            navbar();

            echo'<!-- contenu de la page -->
            <div id="content">
                <h1>Nos cours et exercices</h1>
                <p class="p_texte">
                Bienvenue dans l\'aventure ! Ici tu trouveras tout nos cours. N\'hésite pas à cliquer dessus, tu y trouveras aussi les exercices qui leur sont associés ! 
                </p>

                <div class="container" id="div_square">
                    <div class="row">';
                        while ($row = $requete->fetch(PDO::FETCH_OBJ)) {
                            // affichage des thèmes 
                            // chaque bouton est associé à la page cours_exo.php et envoie la valeur du thème avec la méthode GET
                            echo '
                            <form action="cours_exo.php" method="GET" class="col text-center">
                                <button type="submit" class="square" name="theme" value="' . $row->theme . '">' . $row->theme . '</button>
                            </form>';
                        }
                    echo '</div>
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