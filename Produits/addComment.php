<?php

session_start();

require_once "../main_backend/vendor/autoload.php";

use DatabaseInformations\DbInformations;

if (!empty($_POST['userComment'])) {

    $userComment = htmlspecialchars($_POST['userComment']);
    
    $tmpDb = new DbInformations();
    $db = $tmpDb->getDbInformations();

    $addComment = $db->prepare("CALL AddComment(:id_product, :username, :comment, :date)");
    $addComment->bindValue(":id_product",$_SESSION['idProduct']);
    $addComment->bindValue(":username",$_SESSION['firstName'] . ' ' . $_SESSION['lastName']);
    $addComment->bindValue(":comment",$userComment);
    $addComment->bindValue(":date",date('Y-m-d H:i:s'));

    $addComment->execute();
    $addComment->closeCursor();

}

header("location:./descriptionProduit.php");

