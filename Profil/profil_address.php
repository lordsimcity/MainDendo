<?php

session_start();

require_once "../main_backend/vendor/autoload.php";

use DatabaseInformations\DbInformations;

$tmpDb = new DbInformations();
$db = $tmpDb->getDbInformations();

if ($_REQUEST['update']) {

    $updateAddress = $db->prepare("CALL UpdateUserAddress(:number,:street,:city,:postal_code,:id_user)");

    $updateAddress->bindValue(":number", htmlspecialchars($_POST['number']));
    $updateAddress->bindValue(":street", htmlspecialchars($_POST['street']));
    $updateAddress->bindValue(":city", htmlspecialchars($_POST['city']));
    $updateAddress->bindValue(":postal_code", htmlspecialchars($_POST['zipCode']));
    $updateAddress->bindValue(":id_user", $_SESSION['idUser']);

    $updateAddress->execute();

} else {

    $addAddress = $db->prepare("CALL AddUserAddress(:id_user,:number,:street,:city,:postal_code)");

    $addAddress->bindValue(":id_user", $_SESSION['idUser']);
    $addAddress->bindValue(":number", htmlspecialchars($_POST['number']));
    $addAddress->bindValue(":street", htmlspecialchars($_POST['street']));
    $addAddress->bindValue(":city", htmlspecialchars($_POST['city']));
    $addAddress->bindValue(":postal_code", htmlspecialchars($_POST['zipCode']));

    $addAddress->execute();

}

header("location:./profil.php");
