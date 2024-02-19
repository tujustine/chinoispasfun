<?php
    require_once("./connect_db.php");
    entete();

    echo '<!-- body -->
    <body id="body">';

        navbar();

        echo '<!-- contenu de la page -->
        <div id="content">                

            <!-- div dans laquelle sera affichée le message une fois le formulaire envoyé -->           
            <div id="confirmation" class="text-center">
            <p>Merci pour ton message ' . $_POST["prenom"] . ' !<br/>
            Ton message a bien été envoyé. On revient vers toi dès que possible.</p>
            <p>Résumé de la demande : <br/>
            <b>Utilisateur : </b>' . $_POST["prenom"] . ' ' . $_POST['nom'] . '<br/>
            <b>Email : </b>' . $_POST["mail"] . '<br/>
            <b>Message : </b>' . $_POST["message"] . '</p>
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