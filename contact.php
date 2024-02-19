<?php
    require_once("./connect_db.php");
    entete();

    echo '<!-- body -->
    <body id="body">';

        navbar();

        echo '<!-- contenu de la page -->
        <div id="content">
            <h1>Formulaire de contact</h1>
            <div id="content_to_hide">
                <p class="p_texte">Si tu as des questions, des suggestions ou si tu veux seulement me laisser un commentaire, tu peux remplir le formulaire ci-dessous. </p>
                <!-- post pour éviter que les messages soient visibles dans l\'historique du navigateur -->
                <form method="post" id="contactform" action="./confirmation.php">
                    <div class="row mb-3">
                        <div class="col-sm-6">
                            <label for="prenom" class="col-sm-2 col-form-label fw-bold">Prénom </label>
                            <input type="text" class="form-control" id="prenom" name="prenom" placeholder="Xiao" required>
                        </div>
                        <div class="col-sm-6">
                            <label for="nom" class="col-sm-2 col-form-label fw-bold">Nom </label>
                            <input type="text" class="form-control" id="nom" name="nom" placeholder="Wu" required>
                        </div>
                        <div class="mb-3">
                            <div class="row">
                                <label for="mail" class="col-sm-2 col-form-label fw-bold">E-mail </label>
                                <div class="col-sm-12">
                                    <input type="email" id="mail" class="form-control" name="mail" placeholder="pas@fun.com" required>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="row">
                                <label for="message" class="col-sm-4 col-form-label fw-bold">Dites-moi tout ! </label>
                                <div class="col-sm-12">
                                    <textarea id="message" class="form-control" name="message" placeholder="Votre message..." required></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto btn-submit-contact">
                        <!-- bouton pour envoyer le formulaire et déclencher en même temps les fonctions qui lui sont associées -->
                        <button id="bouton-envoi" type="submit" class="btn btn-outline-light mb-4">Envoyer</button>
                    </div>
                </form>
            </div>';

            // si le champ du message n'est pas vide, on envoie un mail à l'adresse indiquée
            // techniquement, la fonction mail permet juste de vérifier que la demande d'envoi de courrier est soumise au serveur 
            if ($_POST['message']) {
                $prenom = $_POST['prenom'];
                $nom = $_POST['nom'];
                $mail = $_POST['mail'];
        
                $message = '<p><b>Utilisateur : </b>' . $prenom . ' ' . $nom . '<br>
                <b>Email : </b>' . $mail . '<br>
                <b>Message : </b>' . $_POST['message'] . '</p>';
        
                $retour = mail('jujustine.tu@gmail.com', 'Formulaire de contact', $message);
            }
                

            echo'<!-- div dans laquelle sera affichée le message une fois le formulaire envoyé -->           
            <div id="confirmation" class="text-center"></div>
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