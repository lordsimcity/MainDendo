<?php

/* Fichier permettant de supprimer la session en cours */

session_start();

unset($_SESSION['idUser']);
unset($_SESSION['lastName']);
unset($_SESSION['firstName']);
unset($_SESSION['userEmail']);

session_destroy();
/* Redirection vers la page de connexion */

header("location:../index.php");