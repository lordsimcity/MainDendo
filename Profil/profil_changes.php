<?php

session_start();

require_once "../main_backend/vendor/autoload.php";

use DatabaseInformations\DbInformations;

$tmpDb = new DbInformations();
$db = $tmpDb->getDbInformations();

date_default_timezone_set("Europe/Paris");
$date = date("Y-m-d H:i:s");

if (!empty($_POST['pwd']) && !empty($_POST['new_mail'])) {

    $pwd = htmlspecialchars(($_POST['pwd']));
    $new_mail = htmlspecialchars(($_POST['new_mail']));

    $treatment = $db->prepare("CALL SelectUser(:mail_address)");
    $treatment->bindValue(":mail_address",$_SESSION['userEmail']);
    $treatment->execute();

    $data = $treatment->fetch(PDO::FETCH_ASSOC);

    $treatment->closeCursor();

    if ($data != null) {

        if (password_verify($pwd, $data['password'])) {
            $emailChange = $db->prepare("CALL UpdateUserEmail(:new_mail_address,:new_date,:mail_address)");
            $emailChange->bindValue(":new_mail_address",$new_mail);
            $emailChange->bindValue(":new_date",$date);
            $emailChange->bindValue(":mail_address",$_SESSION['userEmail']);
            $emailChange->execute();

            $emailChange->closeCursor();

            header("location:../main_backend/logout.php");
        } else {
            echo "Mauvais mot de passe, veuillez réessayer.";
            ?>
                <a href="./profil.php"> > Retourner à ma page profil</a>
            <?php
        }
        
        $treatment->closeCursor();
        return true;

    } 

} elseif (!empty($_POST['pwd']) && !empty($_POST['new_pwd']) && !empty($_POST['new_pwd_check'])) {
    $pwd = htmlspecialchars(($_POST['pwd']));
    $new_pwd = htmlspecialchars(($_POST['new_pwd']));
    $new_pwd_check = htmlspecialchars(($_POST['new_pwd_check']));

    if ($new_pwd === $new_pwd_check) {

        $treatment = $db->prepare("CALL SelectUser(:mail_address)");
        $treatment->bindValue(":mail_address",$_SESSION['userEmail']);
        $treatment->execute();

        $data = $treatment->fetch(PDO::FETCH_ASSOC);

        $treatment->closeCursor();

        if ($data != null) {

            if (password_verify($pwd, $data['password'])) {
                $passwordChange = $db->prepare("CALL UpdateUserPassword(:new_password,:new_date,:mail_address)");
                $passwordChange->bindValue(":new_password",password_hash($new_pwd,PASSWORD_DEFAULT));
                $passwordChange->bindValue(":new_date",$date);
                $passwordChange->bindValue(":mail_address",$_SESSION['userEmail']);
                $passwordChange->execute();

                $passwordChange->closeCursor();

                echo "Votre mot de passe a bien été modifiée :-). Merci de vous reconnecter à votre espace personnel.";
                ?>
                    <a href="../main_backend/logout.php"> > Déconnexion</a>
                <?php
            } else {
                echo "Le mot de passe renseigné en tant que mot de passe actuel n'est pas le bon, veuillez réessayer.";
                ?>
                    <a href="./profil.php"> > Retourner à ma page profil</a>
                <?php
            }
            
            $treatment->closeCursor();
            return true;

        }
    } else {
        echo "Les deux mots de passe ne sont pas identiques !";
        ?>
            <a href="./profil.php"> > Retourner à ma page profil</a>
        <?php
    }
} else {

    echo "Un problème a été rencontré !";
    ?>
    
        <a href="./profil.php"> > Retourner à ma page profil</a>

    <?php

}