<?php

session_start();

require_once "../../main_backend/vendor/autoload.php";

use DatabaseInformations\DbInformations;

$tmpDb = new DbInformations();
$db = $tmpDb->getDbInformations();

/* $getOrderList = $db->prepare("SELECT * FROM Orders WHERE id_user = :id_user");
$getOrderList->bindValue(":id_user",$_SESSION['idUser']);
$getOrderList->execute(); */

$getOrderList = $db->query("CALL UserOrders(". $_SESSION['idUser'] .")");

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="./style/orderHistoryStyle.css">
    <title>Mon historique de commande</title>
</head>
<body>
    <h2>Mon historique de commande(s)</h2>
    <p></p>
    <div class="shadow history-list">
        <ul class="list-group">
            <?php
                while ($orderList = $getOrderList->fetch(PDO::FETCH_ASSOC)) {
                    echo "<li class=\"list-group-item\">";
                    echo "<p>Numéro de commande : <b>" . $orderList['id_order'] . "</b> | Date de validation de la commande : " . $orderList['date_created_order'] . "</p>";
                    echo "<p>Montant de la commande : " . $orderList['amount_order'] . " € <a href=\"./orderDetails.php?orderId=". $orderList['id_order'] ."\">> Voir les détails de la commande </a></p>";
                    echo "</li>";
                }
            ?>
        </ul>
    </div>
    <p></p>
    <a href="../profil.php">> Mon profil</a>
</body>
</html>