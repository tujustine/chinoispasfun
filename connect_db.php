<?php 
    function connexion(){
        // Connexion à MySQL avec affichage des résultats en UTF-8
        // avec gestion des erreurs potentielles
        // Définition des 4 paramètres
        $serveur = "localhost" ;
        $bd = "chinoispasfun" ;
        $login = "root" ;
        $mdp = "$$$$" ;

        try {
            $sql = new PDO('mysql:host='.$serveur.';dbname='.$bd, $login, $mdp,
            array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")) ;
            // echo "Connexion réussie";
            // echo "<br/>";
            return $sql;
        }

        catch(PDOException $e) {
            // echo "Erreur de connexion à la base de données " . $e->getMessage() ;
            die();
        }
    }

    function entete() {
        echo '<!DOCTYPE html>
    <html lang="fr" xmlns="http://www.w3.org/1999/xhtml">
        <head>
            <!-- titre de l\'onglet -->
            <title>Chinois(Pas)Fun</title>

            <!-- balise obligatoire à propos des métadonnées -->
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

            <!-- scripts pour faire fonctionner bootstrap -->
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">        
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"></script>
            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

            <!-- liens pour les polices importées de google font -->
            <link rel="preconnect" href="https://fonts.googleapis.com">
            <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
            <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@200&family=Reem+Kufi+Fun&family=ZCOOL+KuaiLe&display=swap" rel="stylesheet">

            <!-- scripts javascript -->
            <script type="text/javascript" src="./static/js/switch-mode.js"></script>
            <script type="text/javascript" src="./static/js/affichage.js"></script>
            <!--<script type="text/javascript" src="./static/js/confirmation.js"></script>-->
            <!--<script type="text/javascript" src="./static/js/choix-theme.js"></script>-->
            <script type="text/javascript" src="./static/js/log-affichage.js"></script>
            <script type="text/javascript" src="./static/js/exercices.js"></script>

            <!-- feuille de style css -->
            <link rel="stylesheet" media="screen" type="text/css" href="./static/css/style.css"/>
        </head>';
    }

    function navbar(){
        echo '            
        <header>
            <!-- barre de navigation réalisé avec boostrap -->
            <nav class="navbar navbar-expand-lg navbar-light">
                <div class="container-fluid">
                <a class="logo navbar-brand" href="./index.php"><img src="./img/logo3.png" alt="Logo" >Chinois(Pas)Fun</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="./index.php">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./cours_exo_accueil.php">Leçons et Exercices</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./compte.php">Mon Compte</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./contact.php">Contact</a>
                    </li>
                    </ul>
                </div>
                </div>
            </nav>
        </header>';
    }

    function switch_theme(){
        echo'<!-- bouton pour changer de mode clair/sombre-->
        <div>
            <!-- par défaut, le site est en mode sombre -->
            <button id="theme-switcher"><img src="./img/nuit.png" alt="mode sombre" id="theme-icon"></button>
        </div>';    
    }

    function footer(){
        echo '<!-- footer avec l\'inscription à la newsletter également réalisé avec bootstrap -->
        <footer class="text-center">
            <div class="container p-3 pb-0">
                <form method="post">
                    <div class="row d-flex justify-content-center">
                        <div class="col-auto">
                            <p class="pt-2 newsletter-color"><b>Newsletter</b></p>
                        </div>
                        <div class="col-md-5 col-6">
                            <div class="form-outline form-white mb-4">
                                <input id="form5Example29" class="form-control" type="email" name="email" placeholder="pic@pouc.com" required>
                            </div>     
                        </div>
                        <div class="col-auto">
                            <button type="submit" id="bouton-envoi-newsletter" class="btn btn-outline-light mb-4">Envoyer</button>
                        </div>
                    </div>
                </form> 
                <p class="newsletter-color"><b>© Chinois(Pas)Fun • Site développé par Justine Tu</b></p>
            </div>
        </footer>
    </body>
</html>';
    }
?>