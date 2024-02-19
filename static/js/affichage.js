/* 
    fonction qui affiche soit la partie cours, soit la partie exercices
    et qui permet de colorer les boutons en fonction de l'onglet sur lequel on se trouve
*/

$(document).ready(function () {
    function affichage(bouton) {
        if (bouton === "cours") {
            // d-none équivaut à display:none; donc l'affichage ou non d'un contenu
            // si on appuie sur l'onglet cours, on veut que la partie cours s'affiche mais que la partie exercice soit cachée
            $('.cours').removeClass('d-none');
            $('.exo').addClass('d-none');
            // on met de l'ombre sur l'onglet cours afin de signaler que l'on est sur cet onglet et on met les autres onglets à 0
            $("#btn-choice-cours").css("box-shadow", "0px -3px 10px 0px rgba(0, 0, 0, 0.2)");
            $("#btn-choice-exo").css("box-shadow", "0px 0px 0px 0px rgba(0, 0, 0, 0.2)");
            $("#btn-choice-all-cours").css("box-shadow", "0px 0px 0px 0px rgba(0, 0, 0, 0.2)");

        } else if (bouton === "exercices") {
            $('.exo').removeClass('d-none');
            $('.cours').addClass('d-none');
            $("#btn-choice-cours").css("box-shadow", "0px 0px 0px 0px rgba(0, 0, 0, 0.2)");
            $("#btn-choice-exo").css("box-shadow", "0px -3px 10px 0px rgba(0, 0, 0, 0.2)");
            $("#btn-choice-all-cours").css("box-shadow", "0px 0px 0px 0px rgba(0, 0, 0, 0.2)");

        } else if (bouton === "all") {
            $("#btn-choice-cours").css("box-shadow", "0px 0px 0px 0px rgba(0, 0, 0, 0.2)");
            $("#btn-choice-exo").css("box-shadow", "0px 0px 0px 0px rgba(0, 0, 0, 0.2)");
            $("#btn-choice-all-cours").css("box-shadow", "0px -3px 10px 0px rgba(0, 0, 0, 0.2)");
        }
    }

    // appel de la fonction affichage lorsqu'on clique sur le bouton associé
    $('#btn-choice-cours').click(function() {
        affichage('cours');
    });

    $('#btn-choice-exo').click(function() {
        affichage('exercices');
    });

    $('#btn-choice-all-cours').click(function() {
        affichage('all');
    });
});
