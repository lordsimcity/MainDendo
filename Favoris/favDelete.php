<?php

session_start();

require_once "../main_backend/vendor/autoload.php";

use DatabaseInformations\DbInformations;

if ($_GET['del1'] != null) {

    $tmpDb = new DbInformations();
    $db = $tmpDb->getDbInformations();

    $query = $db->prepare("CALL DeleteSpecificFavorite(:id_product, :fk_id_user)");
    $query->bindValue(":id_product",$_GET['del1']);
    $query->bindValue(":fk_id_user",$_SESSION['idUser']);

    $query->execute();

    $query->closeCursor();
    header("location:./favoris.php");
}
