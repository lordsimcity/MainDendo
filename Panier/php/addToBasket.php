<?php

namespace Basket;

require_once "../vendor/autoload.php";
require_once "../../main_backend/vendor/autoload.php";

use PDO;
use Basket\BasketClass\Database\DbManager;
use Basket\BasketClass\BasketHandling\BasketManager;

use DatabaseInformations\DbInformations;


session_start();

$tmpDb = new DbInformations();
$db = $tmpDb->getDbInformations();

// Si la session existe, les articles du panier seront stockés en base de données.
if (isset($_SESSION['userEmail'])) {

    if (isset($_GET['idProduct'])) {
        $dbConnection = new DbManager($db);

        $product = $dbConnection->query("CALL SelectProduct(". $_GET['idProduct'] .")");
        $fk_idUser = $_SESSION['idUser'];
        if (empty($product)) {
            die("Ce produit n'est pas présent en base de données !");
        }
        $dbConnection->add($product,$fk_idUser);
        header("location:../basket.php");
    } else {
        echo "Vous n'avez pas sélectionner de produits à ajouter au panier";
    }
// Sinon, ils seront stockés uniquement en session.
} else {

    if (isset($_GET['idProduct'])) {
        $dbConnection = new DbManager($db);
        $product = $dbConnection->query("CALL SelectIdProduct(:idProduct)", array("idProduct" => $_GET['idProduct']));
        if (empty($product)) {
            die("Ce produit n'est pas présent en base de données !");
        }
        $sessionBasket = new BasketManager($db);
        $sessionBasket->add($product[0]['id_product']);
        header("location:../basket.php");
    } else {
        echo "Vous n'avez pas sélectionner de produits à ajouter au panier";
    }

}