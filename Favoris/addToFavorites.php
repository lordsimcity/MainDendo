<?php

session_start();

/* use Basket\BasketClass\Database\DbManager;

require "../Panier/vendor/autoload.php"; */

require_once "../main_backend/vendor/autoload.php";

use DatabaseInformations\DbInformations;

if (isset($_GET['idProduct'])) {

    $tmpDb = new DbInformations();
    $db = $tmpDb->getDbInformations();

    $checkInFavorites = $db->prepare("CALL SelectFavorite(:id_product,:fk_id_user)");

    $checkInFavorites->bindValue(":id_product",$_GET['idProduct']);
    $checkInFavorites->bindValue(":fk_id_user",$_SESSION['idUser']);

    $checkInFavorites->execute();

    $res = $checkInFavorites->fetch(PDO::FETCH_ASSOC);

    $checkInFavorites->closeCursor();

    if ($res == null) {
        $query = $db->prepare("CALL AddFavorite(:fk_id_user,:id_product)");
        $query->bindValue(":id_product",$_GET['idProduct']);
        $query->bindValue(":fk_id_user",$_SESSION['idUser']);

        try {
            $query->execute();
        } catch (PDOException $e) {
            echo $e;
        } 

        $query->closeCursor();
        header("location:./favoris.php");
    } else {
        header("location:./favoris.php");
    }
} else {
    echo "Vous n'avez pas sélectionner de produits à ajouter aux favoris";
}