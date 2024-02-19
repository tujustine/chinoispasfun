/* 
    code permettant de gérer le bon fonctionnement des exercices
*/

$(document).ready(function () {
    var questions = document.getElementsByClassName("question");
    // indice de la question courante
    var currentQuestionIndex = 0;
    // variable pour indiquer si la réponse a été indiquée ou pas
    // permet ainsi d'éviter que l'utilisateur change de réponse une fois sélectionnée
    var answered = false;
    // nombre total de bonnes réponses
    var totalBonnesReponses = 0;

    function nextQuestion() {
        // fonction permettant d'afficher la question suivante
        // vérifie si la question courante n'est pas la dernière question
        if (currentQuestionIndex < questions.length - 1) {
            // masque la question courante
            questions[currentQuestionIndex].style.display = "none";
            // incrémente le compteur de la question courante pour signifier qu'on passe à la question suivante
            currentQuestionIndex++;
            // affiche la question suivante
            questions[currentQuestionIndex].style.display = "flex";
            // réinitialise answered à false pour pouvoir sélectionner une réponse
            answered = false;
        }
    }

    // la boucle for est utilisée pour cacher toutes les questions sauf la première 
    for (var i = 1; i < questions.length; i++) {
        questions[i].style.display = "none";

        // récupère le bouton suivant correspondant à chaque question et appel la fonction nextQuestion
        // lorsque l'on clique dessus
        var nextQuestionBtn = document.getElementById("next-question-btn-" + i);
        nextQuestionBtn.addEventListener("click", nextQuestion);
    }

    function verifReponse(element, reponse) {
        // cette fonction vérifie la réponse sélectionnée par l'utilisateur 
        // elle prend en argument la réponse sur laquelle l'utilisateur a cliqué et la réponse attendue
        // vérifie si une réponse n'a pas déjà été donnée
        if (!answered) {
            // récupère la réponse attendue
            var reponse = element.getAttribute('data-reponse');
            var currentQuestion = questions[currentQuestionIndex];
            var allReponses = currentQuestion.querySelectorAll('.reponse');
            // réinitialise la couleur de fond de toutes les réponses de la question courante
            allReponses.forEach(function (reponseElement) {
                reponseElement.style.backgroundColor = '';
            });

            // comparaison de la réponse de l'utilisateur et de la réponse attendue
            // innerText = propriété javascript pour obtenir le contenu textuel d'un élément HTML
            if (element.innerText === reponse) {
                element.style.backgroundColor = '#8CC33C';
                totalBonnesReponses++;
            } else {
                element.style.backgroundColor = '#D83232';
            }
            //  answered est défini sur true de sorte que l'utilisateur ne puisse pas sélectionner d'autres réponses
            answered = true;
        }
    }

    // événenemnt lorsque l'on clique sur une réponse 
    // appel de la fonction verifReponse pour comparer les réponses et colorer en vert ou en rouge
    var reponses = document.querySelectorAll('.question .reponse');
    reponses.forEach(function (reponse) {
        reponse.addEventListener('click', function () {
            verifReponse(this, this.innerText);
        });
    });

    function terminerExercice() {
        // cette fonction a pour objectif d'afficher le score final de l'utilisateur pour un exercice donné
        var score = totalBonnesReponses + "/" + questions.length;
        $("#score").append(score);

        // le score est affiché sous forme d'alerte
        alert("Votre score : " + score);
    }
    
    // repère le bouton qui a pour id finish-btn et appel de la fonction terminerExercice
    // lorsque l'on clic dessus
    var finishBtn = document.getElementById("finish-btn");
    finishBtn.addEventListener("click", terminerExercice);
});
