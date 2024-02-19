<?php    
    session_start();
    require_once("./connect_db.php");
    $sql = connexion();

    // récupération du thème envoyé par la page cours_exo_accueil.php
    $theme = $_GET['theme'];
    // sauvegarde dans une variable de session pour pouvoir la réutiliser plus tard
    $_SESSION['theme'] = $theme;

    // sélection de toutes les données dans la table mot qui a pour thème, le thème sélectionné précédemment
    $requete_mot = $sql->prepare("SELECT * FROM mot WHERE theme = :theme") ;
    $requete_mot->bindParam(":theme", $theme);
    $resultat = $requete_mot->execute();
                
    entete();

    echo '
    <!-- body -->
    <body id="body">';

        navbar();

        echo '
        <!-- boutons faisant appel au script javascript affichage lorsqu\'on clic dessus -->
        <!-- ces boutons permettent de passer d\un onglet à un autre sans changer de page --> 
        <div class="btn-cours-exo">
            <a href="./cours_exo_accueil.php" id="btn-choice-all-cours" class="btn-choice"><div id="all-cours">Tous les cours</div></a>
            <button class="btn-choice" id="btn-choice-cours">Cours</button>
            <button class="btn-choice" id="btn-choice-exo">Exercices</button>
        </div>

        <!-- contenu de la page -->
        <div id="content-exception">
            <!-- onglet cours --> 
            <div class="cours">
                <h1>' . $theme . '</h1>
                <p class="p_texte">Tu trouveras les exercices qui sont associés à cet exercice dans l\'onglet "Exercices" </p>
                <div class="container">
                    <div class="row">
                        <div class="col text-center">
                            <div class="p-3 div-legende">
                                <div class="row">
                                    <div class="col legende"><b>hanzi</b></div>
                                    <div class="col legende"><b>pinyin</b></div>
                                    <div class="col legende"><b>traduction</b></div>
                                    <div class="col legende"><b>exemple</b></div>
                                </div>
                            </div>    
                        </div>
                    </div>';
                    // parcours les résultats de la requête pour afficher les informations tant qu'il y en a 
                    // ce qui est affiché c'est donc le cours du thème spécifié
                    while($ligne = $requete_mot->fetch(PDO::FETCH_OBJ)) {
                        echo '
                        <div class="row">
                            <div class="col text-center">
                                <div class="p-3 div-car">
                                    <div class="row">
                                        <div class="col hanzi">' . $ligne->mot . '</div>
                                        <div class="col pinyin">' . $ligne->pinyin .' </div>
                                        <div class="col traduction">' . $ligne->traduction . '</div>
                                        <div class="col exemples">' . $ligne->exemple . '</div>
                                    </div>       
                                </div>             
                            </div>
                        </div>';
                    }  
                    
                    // sélection de toutes les données dans la table exercices qui a pour thème, le thème sélectionné précédemment
                    $requete_exo = $sql->prepare("SELECT * FROM exercices WHERE theme = :theme") ;
                    $requete_exo->bindParam(":theme", $theme);
                    $resultat = $requete_exo->execute();
            
                    echo'
                </div>
            </div>

            <!-- onglet exercices --> 
            <div class="exo d-none">
                <h1>' . $theme . '</h1>
                <p class="p_texte">Sélectionne la bonne réponse !</p>
                <div class="container" id="questions-container">';
                    // nombre total de questions
                    $questionCount = $requete_exo->rowCount(); 
                    // indice de la question courante
                    $currentQuestionIndex = 0; 
                    // identifiant de l'exercice
                    $idExo = 0;

                    // parcours les résultats de la requête pour afficher les informations tant qu'il y en a 
                    // ce qui est affiché c'est donc les exercices du thème spécifié
                    while($ligne2 = $requete_exo->fetch(PDO::FETCH_OBJ)) {
                        // incrémente l'indice de la question courante
                        $currentQuestionIndex++;
                        // récupération de l'id de l'exercice afin de l'insérer dans la base de données
                        $idExo = $ligne2->id_exercice; 

                        echo '
                    <div class="row question">
                        <!-- div carrée contenant le mot à trouver -->
                        <div class="col-md-6 text-center div-hanzi-square">
                            <div class="hanzi-square">' . $ligne2->question . '</div>
                        </div>

                        <!-- div rectangulaires contenant les propositions de réponse -->
                        <div class="col-md-6 text-center div-div-rep">
                            <div class="row div-rep ">
                                <!-- l\'attribut data-reponse sera utile dans le code js exercices.js -->
                                <!-- il contient la bonne réponse à la question courante -->
                                <!-- il sera utilisé pour vérifier si la réponse sélectionnée est bonne ou pas -->
                                <!-- et ainsi incrémenter le score mais aussi colorer la div en vert si la réponse est bonne sinon en rouge -->
                                <div class="col-md-12 reponse" data-reponse="'.$ligne2->reponse. '" >'
                                .$ligne2->A.
                                '</div>
                                <div class="col-md-12 reponse" data-reponse="'.$ligne2->reponse.'" >'
                                .$ligne2->B.
                                '</div>
                                <div class="col-md-12 reponse" data-reponse="'.$ligne2->reponse.'" >'
                                .$ligne2->C.
                                '</div>
                            </div>
                        </div>

                        <!-- affichage du bouton --> 
                        <div class="text-center">';
                            // si nous arrivons à la dernière question de l'exercice, alors on affiche 
                            // un bouton pour terminer l'exercice et afficher le score obtenu
                            if ($currentQuestionIndex === $questionCount) {
                                echo '<button id="finish-btn" class="btn btn-outline-light mb-4 col-md-4">Terminer</button>';
                            // s'il y a encore des questions alors on affiche un bouton question suivante
                            } else {
                                // le bouton a un identifiant unique pour chaque question car sinon on ne pouvait pas passer à la question suivante
                                // seul le premier bouton fonctionnait 
                                // cet identifiant unique est réutilisé dans le js exercices.js
                                echo '<button id="next-question-btn-' . $currentQuestionIndex . '" class="next-btn btn btn-outline-light mb-4 col-md-4">Question suivante</button>';
                            }
                        echo '
                        </div>
                    </div>';
                    } 

                    // ajout des résultats de l'utilisateur dans la base de données si celui ci est connecté
                    if ($_SESSION['userId']) {
                        echo '
                        <div id="score" style="display: none;"></div>';
        
                        // requête sql pour récupérer le theme associé à l'id de l'exo -> le stocker dans une variable de session pour l'utiliser dans compte

                        // echo $_GET['score'];
                        // Récupérer l'identifiant de l'utilisateur et l'identifiant de l'exercice
                        $idUtilisateur = $_SESSION['userId'];                                    
                        $date = date("Y-m-d H:i:s");

                        // Insérer les informations dans la table "resultats"
                        // $insertQuery = $sql->prepare("INSERT INTO resultats (id_utilisateur, id_exercice, resultat, date_resultat) VALUES (:idUtilisateur, :idExercice, :resultat, :date_resultat)");
                        // $insertQuery->bindParam(':idUtilisateur', $idUtilisateur);
                        // $insertQuery->bindParam(':idExercice', $idExo);
                        // $insertQuery->bindParam(':resultat', $_POST['score']);
                        // $insertQuery->bindParam(':date_resultat', $date);
                        // $insertQuery->execute();
                    }     
                
                echo'
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