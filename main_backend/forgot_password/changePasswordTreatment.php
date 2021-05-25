<?php

session_start();

require_once "../vendor/autoload.php";

use DatabaseInformations\DbInformations;

if (!empty($_POST['changePassword']) && !empty($_POST['changePasswordCheck'])) {
    $pwd = htmlspecialchars(($_POST['changePassword']));
    $new_pwd = htmlspecialchars(($_POST['changePasswordCheck']));

    if ($pwd === $new_pwd) {
        $tmpDb = new DbInformations();
        $db = $tmpDb->getDbInformations();

        date_default_timezone_set("Europe/Paris");
        $date = date("Y-m-d H:i:s");

        $passwordChange = $db->prepare("CALL UpdateUserPassword(:new_password,:new_date,:mail_address)");
        $passwordChange->bindValue(":new_password",password_hash($pwd,PASSWORD_DEFAULT));
        $passwordChange->bindValue(":new_date",$date);
        $passwordChange->bindValue(":mail_address",$_SESSION['userEmail']);
        $passwordChange->execute();

        $passwordChange->closeCursor();

        echo "Votre mot de passe a bien été modifiée :-) !";
        ?>
            <a href="../../index.php"> > Accueil</a>
        <?php
    } else {
        echo "Les 2 mots de passe ne sont pas identiques !";
        ?>
            <a href="./forgot_password.php"> > Réessayer</a>
        <?php
    }

    unset($_SESSION['userEmail']);
}