<?php

session_start();

require_once "./vendor/autoload.php";

use Connection\ConnectionChecks\LoginInformations;
use Connection\ConnectionVerif\DatabaseHandling\DatabaseManager;

use DatabaseInformations\DbInformations;


if (isset($_POST['mail_address']) && isset($_POST['password'])) {

    $email = htmlspecialchars($_POST['mail_address']);
    $password = htmlspecialchars($_POST['password']);

    $dataList = [
        'userEmail' => $email,
        'userPassword' => $password
    ];
    
    // Informations de connexion à la base de données :
    $tmpDb = new DbInformations();
    $db = $tmpDb->getDbInformations();
    
    $dbConnection = new DatabaseManager($db);
    
    $connectionInformations = new LoginInformations($dataList);
    
    if ($dbConnection->checksBeforeConnection($connectionInformations->getUserEmail())) {
    
        $res = $dbConnection->getUserInformations($connectionInformations->getUserEmail());

        if (password_verify($connectionInformations->getUserPassword(),$res['password'])) {
        
            header("location:./CodeValidation/connectionCodeValidation.php?idUser=".$res['id_user']."&lastName=".$res['lastname']."&firstName=".$res['firstname']."&userEmail=".$res['mail_address']."");

        } else {

            echo "<p>Le mot de passe est incorrect !</p>";
            echo "<p> <a href=\"../index.php\"> > Retourner à la page d'accueil </a> </p>";

        }
        
    } else {
    
        echo "<p>L'espace personnel n'éxiste pas !</p>";
        echo "<p> <a href=\"../Connexion/connexion.php\"> > Retourner au formulaire de connexion </a> </p>";
        echo "<p> <a href=\"../Inscription/registration.html\"> > S'inscrire </a> </p>";
    
    }

} else {
    header("location:../Connexion/connexion.php");
}
