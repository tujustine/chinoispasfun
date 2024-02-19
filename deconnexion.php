<?php
    session_start();

    // Supprimer toutes les variables de session
    session_unset();

    // Détruire la session
    session_destroy();

    // Rediriger vers la partie connexion
    header('Location: compte.php');
    exit();
?>
