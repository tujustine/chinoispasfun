/* 
    code permettant d'afficher soit la partie inscription, soit la partie connexion
*/

$(document).ready(function () {
    function afficherInscription() {
        // affiche la partie inscription et cache celle de connexion
        document.getElementById("connexion").style.display = "none";
        document.getElementById("inscription").style.display = "block";
    }

    function afficherConnexion() {
        // affiche la partie connexion et cache celle d'inscription
        document.getElementById("connexion").style.display = "block";
        document.getElementById("inscription").style.display = "none";
    }

    // appel des fonctions lorsque l'on clique sur le lien correspondant
    $("#connexion-link").click(function () {
        afficherConnexion();
    });

    $("#inscription-link").click(function () {
        afficherInscription();
    });

});