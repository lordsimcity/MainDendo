<?php

session_start();

require_once "../main_backend/vendor/autoload.php";
require_once "../Panier/vendor/autoload.php";

use DatabaseInformations\DbInformations;
use Basket\BasketClass\Database\DbManager;

$tmpTotalOrder = 0;

$tmpDb = new DbInformations();
$db = $tmpDb->getDbInformations();

$dbConnection = new DbManager($db);

$basketProducts = $dbConnection->query("CALL GetBasket(". $_SESSION['idUser'] .")");

foreach ($basketProducts as $basketProduct) {

    $tmpTotalOrder += $basketProduct['price'] * $basketProduct['quantity'];

}

$totalOrder = round($tmpTotalOrder * 1.2,2);

echo $totalOrder;