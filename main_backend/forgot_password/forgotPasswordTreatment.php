<?php

session_start();

require_once "../vendor/autoload.php";

use DatabaseInformations\DbInformations;

if (isset($_REQUEST['userEmail']) && !empty($_REQUEST['userEmail'])) {

    $userEmail = htmlspecialchars($_REQUEST['userEmail']);

    $_SESSION['userEmail'] = $userEmail;

    $tmpDb = new DbInformations();
    $db = $tmpDb->getDbInformations();
    $query = $db->prepare("CALL SelectUser(:mail_address)");
    $query->bindValue(":mail_address",$userEmail);
    $query->execute();

    if ($query->fetch() != null) {

        $query->closeCursor();

        echo "true";

    } else {

        echo "false";

    }

} else {

    echo "false";

}