/*
    code permettant de passer du mode sombre au mode clair et inversement et de sauvegarder 
    l'information dans le localStorage afin de s'en resservir. 
    Le mode par défaut est le mode sombre mais si on quitte la page en mode clair et 
    qu'on décide de revenir dessus (sans avoir vidé les caches) alors le mode qui s'affiche
    sera le mode clair.
 */

$(document).ready(function () {
    // ajout de l'attribut class au body qui a la valeur récupérée de la clé mode (sera donc light ou dark)
    document.getElementById("body").setAttribute("class", localStorage.getItem("mode"));

    // si on change de fond, il faut aussi changer l'image de changement de theme
    // pour rester en cohérence 
    const savedIcon = localStorage.getItem('icon');
    if (savedIcon) {
        const icon = document.getElementById('theme-icon');
        icon.src = savedIcon;
    }

    function switchMode() {
    // comme son nom l'indique, cette fonction permet de changer de mode  

        // sélectionne le body de la page
        const body = document.querySelector('body');
        // récupère la valeur du mode actuel
        const mode = localStorage.getItem('mode');
    
        // si le mode actuel est le mode sombre, alors on le change en mode clair
        // on change également l'image de changement de mode 
        if (mode === 'dark-screen') {
            // on supprime la valeur dark-screen de la classe 
            body.classList.remove('dark-screen');
            // et on ajoute la valeur light-screen à la place
            body.classList.add('light-screen');
            // on sauvegarde l'information dans la localStorage en ajoutant une clé et une valeur
            // ainsi, l'information du mode choisi est sauvegardé d'une page à l'autre
            // et même si on quitte le site et qu'on revient dessus (il ne faut pas vider ses caches au préalable)
            localStorage.setItem('mode', 'light-screen');
            // on met à jour l'image de changement de mode
            updateThemeIcon('light-screen');
        // si le mode actuel est le mode clair alors on fait l'inverse
        } else {
            body.classList.remove('light-screen');
            body.classList.add('dark-screen');
            localStorage.setItem('mode', 'dark-screen');
            updateThemeIcon('dark-screen');
        }
    }
    
    function updateThemeIcon(mode) {
    // fonction pour mettre à jour l'icône du thème
        // on va chercher d'identifiant theme-icon dans le html
        const icon = document.getElementById('theme-icon');
        // si on est en mode sombre, on met l'image adapté au mode sombre 
        // et inversement pour le mode clair
        if (mode === 'dark-screen') {
            icon.src = './img/nuit.png';
            icon.alt = 'mode sombre';
            localStorage.setItem('icon', './img/nuit.png');
        } else {
            icon.src = './img/matin.png';
            icon.alt = 'mode clair';
            localStorage.setItem('icon', './img/matin.png');
        }
    }

    // on appel la fonction de changement de mode lorsque l'on clique
    // sur le bouton ayant pour identifiant theme-switcher
    $('#theme-switcher').click(function() {
        switchMode();
    });
});