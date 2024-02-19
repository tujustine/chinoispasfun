/*
    la fonction permet de récupérer les valeurs du champs du formulaire une fois que l'utilisateur
    a appuyé sur le bouton envoyé et de faire apparaître un message de confirmation

    N.B. : fichier qui n'est plus utilisé car il a été remplacé par le fichier confirmation.php
 */
$(document).ready(function () {
    $("#contactform").submit(function (event) {
        // empêche le rafraîchissement de la page
        event.preventDefault(); 

        // on récupère la valeur des champs
        var $prenom = $("#prenom").val();
        var $nom = $("#nom").val();
        var $email = $("#mail").val();
        var $message = $("#message").val();

        // on cache le formulaire pour seulement afficher le message de confirmation
        $("#content_to_hide").hide();
        // mise en forme du message de confirmation en ajoutant une propriété css
        $("#confirmation").css("margin-top", "40px");
        // ajout du message dans la div vide dans contact.php en faisant une sélection d'identifiant
        $("#confirmation").append("<p>Merci pour ton message " + $prenom + " !<br/>\
            Ton message a bien été envoyé. On revient vers toi dès que possible.</p>" );
        $("#confirmation").append("<p>Résumé de la demande : <br/>\
            <b>Utilisateur : </b>" + $prenom + ' ' + $nom + "<br/>\
            <b>Email : </b>" + $email + "<br/>\
            <b>Message : </b>" + $message + "</p>");
    });
});