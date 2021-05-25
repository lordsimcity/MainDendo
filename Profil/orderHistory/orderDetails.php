<?php

session_start();

require_once "../../main_backend/vendor/autoload.php";

use DatabaseInformations\DbInformations;

$tmpDb = new DbInformations();
$db = $tmpDb->getDbInformations();

$getOrderLines = $db->query("CALL GetOrderLines(". htmlspecialchars($_SESSION['idUser']) .",". htmlspecialchars($_GET['orderId']) .")");

$tableFormatting = '<table class="table"><tr><th scope="col">Nom du produit</th><th scope="col">Prix unitaire (TTC)</th><th scope="col">Quantité</th><th scope="col">Prix total (TTC)</th></tr>';

$orderAmount = 0;

while ($orderLine = $getOrderLines->fetch(PDO::FETCH_ASSOC)) {

    $orderAmount += $orderLine['totalPrice'];
    $tableFormatting .= '<tr><th scope="row">' . $orderLine['product_name'] . '</th><td>' . $orderLine['unitPrice'] . ' €</td><td>' . $orderLine['quantity'] . '</td><td>' . $orderLine['totalPrice'] . ' €</td></tr>';
}

$tableFormatting .= '</table>';

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="./style/orderHistoryStyle.css">
    <title>Détaile de la commande</title>
</head>
<body>
    <h2>Commande numéro <?= htmlspecialchars($_GET['orderId']); ?></h2>
    <p></p>
    <div class="shadow order-details">
        <?= $tableFormatting; ?>
        <p><b>Montant de la commande : </b> <?= $orderAmount ?> €</p>
    </div>
    <p></p>
    <a href="./orderHistory.php">> Mon historique de commande</a>
</body>
</html>