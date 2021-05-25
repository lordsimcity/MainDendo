<?php

require_once "./vendor/autoload.php";

use Registration\DatabaseHandling\DatabaseManager;
use DendoJitenshaBackend\User\User;
use DendoJitenshaBackend\PasswordEncryption\PasswordEncryption;
use Registration\Informations\RegistrationInformations;

use DatabaseInformations\DbInformations;


if (isset($_POST["firstName"]) && isset($_POST["lastName"]) && isset($_POST["userMail"]) && isset($_POST["password"]) && isset($_POST["passwordVerify"])) {
   
    $lastName = htmlspecialchars($_POST["lastName"]);
    $firstName = htmlspecialchars($_POST["firstName"]);
    $userMail = htmlspecialchars($_POST["userMail"]);
    $password = htmlspecialchars($_POST["password"]);
    $passwordVerify = htmlspecialchars($_POST["passwordVerify"]);

    if ($password === $passwordVerify) {

        $passwordEncryption = new PasswordEncryption($password);
        $passwordToUse = $passwordEncryption->getPassword();

        $userToAdd = [
            "lastName" => $lastName,
            "firstName" => $firstName,
            "userMail" => $userMail,
            "password" => $passwordToUse
        ];

        $tmpDbParams = new DbInformations();
        $dbParams = $tmpDbParams->getDbInformations();

        $dbManager = new DatabaseManager($dbParams);

        try {
            $user = new User($userToAdd);
        } catch (Exception $e) {
            echo $e;
        }

        $test = $dbManager->checksBeforeRegistration($userToAdd['userMail']);

        if($test) {

            $newUser = new RegistrationInformations($userToAdd);
            $dbManager->addUser($newUser);

        }
        
        header("location:../Inscription/registrationValidation.php");

    } else {

        echo "Les deux mots de passe renseignés ne sont pas les mêmes !";
        
    }

} else {
    echo "There is nothing to do here...";
}
