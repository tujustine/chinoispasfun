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
        <div id="content">';
            
            // vérifie si l'utilisateur est connecté
            if ($_SESSION['userId']) {
                // utilisateur connecté
                // récupération de l'identifiant de l'utilisateur et de son mail
                $idUtilisateur = $_SESSION['userId'];
                $email = $_SESSION['userMail'];

                 // requête pour vérifier si l'utilisateur est présent dans la table utilisateurs
                $query = $sql->prepare('SELECT * FROM utilisateurs WHERE mail = :mail');
                $query->bindParam(':mail', $email);
                $query->execute();

                // vérifie si la requête a retourné un résultat
                if ($query->rowCount() > 0) {
                    // récupération de son nom, son prénom et de la date d'inscription
                    $nom = $_SESSION['userLastName'];
                    $prenom = $_SESSION['userFirstName'];
                    $inscription = $_SESSION['userDate'];

                    // L'utilisateur est présent dans la base de données
                    echo '
                    <h1>Mon compte</h1>
                    <p id="bonjour" class="text-center">Bonjour, ' . $prenom . ' !</p>
                    
                    <!-- bouton de déconnexion -->
                    <form method="post" action="deconnexion.php">
                        <button class="btn-deco">
                            <div class="sign">
                                <svg viewBox="0 0 512 512"><path d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z"></path></svg>
                            </div>
                            <div class="text">Déconnexion</div>
                        </button>
                    </form>
                    
                    <!-- affichage des informations sur l\'utilisateur récupérées précedemment -->
                    <div class="section-compte text-center">Mes informations</div>
                    <div>
                        <div><b>Prénom</b> : ' . $prenom . '</div>
                        <div><b>Nom</b> : ' . $nom . '</div>
                        <div><b>Adresse mail</b> : ' . $email . '</div>
                        <div><b>Date d\'inscription</b> : ' . $inscription . '</div>
                    </div>
                    <div class="section-compte text-center">Mes scores</div>';


                    // TODO : afficher le theme, le score, la date d'obtention
                    echo '
                    <div>
                        <div>A VENIR</div>
                    </div>';
                } 

            } else {
                // Utilisateur non connecté

                // si les champs mail et mot de passe sont bien remplis
                if($_POST['email'] && $_POST['password']) {
                    // on récupère le mail et le mot de passe de l'utilisateur
                    $email = $_POST['email'];
                    $password = $_POST['password'];
    
                    // requête pour vérifier si l'utilisateur est présent dans la table utilisateurs
                    $query = $sql->prepare('SELECT * FROM utilisateurs WHERE mail = :mail');
                    $query->bindParam(':mail', $email);
                    $query->execute();

                    // vérifie si la requête a retourné un résultat
                    if ($query->rowCount() > 0) {
                        // l'utilisateur existe dans la base de données
                        $utilisateur = $query->fetch(PDO::FETCH_OBJ);

                        // récupération du mot de passe de l'utilisateur dans la base de données
                        $motDePasseUtilisateur = $utilisateur->mdp;
                
                        // vérifie si le mot de passe saisi correspond au mot de passe enregistré
                        if ($password === $motDePasseUtilisateur) {
                            // Le mot de passe est correct
                            // affichage d'une alerte avec bootstrap
                            echo '
                            <div class="alert alert-success">
                                <b>Connexion en cours...</b>
                            </div>';
                    
                            // les informations de l'utilisateur sont stockées dans la session
                            $_SESSION['userId'] = $utilisateur->id;
                            $_SESSION['userMail'] = $email;
                            $_SESSION['userDate'] = $utilisateur->date_inscription;
                            $_SESSION['userLastName'] = $utilisateur->nom;
                            $_SESSION['userFirstName'] = $utilisateur->prenom;
        
                            // l'utilisateur est redirigé vers la page de son compte
                            header('Location: compte.php');
                            exit();

                        } else {
                        // le mot de passe est incorrect
                        // affichage d'une alerte avec bootstrap
                            echo'
                            <div class="alert alert-danger">
                                <b>Erreur</b> Mot de passe incorrect
                            </div>';
                        }
                    } else {
                        // l'utilisateur n'existe pas dans la base de données
                        // affichage d'une alerte avec bootstrap
                        echo'
                        <div class="alert alert-danger">
                            <b>Erreur</b> Aucun compte lié, veuillez vous inscrire
                        </div>';
                    }
                }

                // vérifie si les données d'inscription ont été soumises
                if ($_POST['nom2'] && $_POST['prenom2'] && $_POST['email2'] && $_POST['password2']) {
                    $nom = $_POST['nom2'];
                    $prenom = $_POST['prenom2'];
                    $email = $_POST['email2'];
                    $password = $_POST['password2'];

                    // requête pour vérifier si le mail existe déjà dans la table utilisateurs
                    $checkQuery = $sql->prepare('SELECT * FROM utilisateurs WHERE mail = :mail');
                    $checkQuery->bindParam(':mail', $email);
                    $checkQuery->execute();

                    // vérifie si la requête a retourné un résultat
                    if ($checkQuery->rowCount() > 0) {
                        // le mail existe déjà dans la base de données
                        echo'
                        <div class="alert alert-warning">
                            <b>Attention</b> Cet e-mail est déjà utilisée.
                        </div>';

                    } else if ($checkQuery->rowCount() === 0) {
                        // le mail n'existe pas dans la base de données
                        // insertion des informations

                        // format pour datetime
                        $date = date("Y-m-d H:i:s");

                        $insertQuery = $sql->prepare("INSERT INTO utilisateurs (nom, prenom, mail, mdp, date_inscription) VALUES (:nom, :prenom, :mail, :mdp, :date_inscription)");
                        $insertQuery->bindParam(':nom', $nom);
                        $insertQuery->bindParam(':prenom', $prenom);
                        $insertQuery->bindParam(':mail', $email);
                        $insertQuery->bindParam(':mdp', $password);
                        $insertQuery->bindParam(':date_inscription', $date);
                        $insertQuery->execute();

                        echo '
                        <div class="alert alert-success">
                            <b>Inscription réussie !</b>
                        </div>';
                    }
                }

                echo '
                <!-- connexion -->
                <form method="post" action="./compte.php">
                    <div class="container" id="connexion">
                        <div class="card">
                            <p class="login">Connexion</p>
                            <div class="inputBox1">
                                <input type="email" name="email" required="required">
                                <span>Email</span>
                            </div>
                            <div class="inputBox">
                                <input type="password" name="password" required="required">
                                <span>Mot de passe</span>
                            </div>
                            <button type="submit" name="valider" class="enter">Valider</button>
                            <p>Pas de compte ? <a href="#" id="inscription-link">S\'inscrire</a></p>
                        </div>
                    </div>
                </form>';  


                echo '
                <!-- inscription -->
                <form method="post" action="./compte.php">
                    <div class="container" id="inscription" style="display: none;">
                        <div class="card">
                            <p class="singup">Inscription</p>
                            <div class="inputBox3">
                                <input type="text" name="nom2" required="required">
                                <span>Nom</span>
                            </div>
                            <div class="inputBox2">
                                <input type="text" name="prenom2" required="required">
                                <span>Prénom</span>
                            </div>
                            <div class="inputBox1">
                                <input type="email" name="email2" required="required">
                                <span class="user">Email</span>
                            </div>
                            <div class="inputBox">
                                <input type="password" name="password2" required="required">
                                <span>Mot de passe</span>
                            </div>
                            <button class="enter">Valider</button>
                            <p>Déjà un compte ? <a href="#" id="connexion-link">Se connecter</a></p>
                        </div>
                    </div>
                </form>';
            }

            echo '
            </div>
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