<?php

session_start();

require_once "../main_backend/vendor/autoload.php";
require_once "../Panier/vendor/autoload.php";

use DatabaseInformations\DbInformations;
use Basket\BasketClass\Database\DbManager;

$tmpDb = new DbInformations();
$db = $tmpDb->getDbInformations();

$dbConnection = new DbManager($db);

$basketProducts = $dbConnection->query("CALL GetBasket(". $_SESSION['idUser'] .")");
$addressInformations = $db->query("CALL GetUserAddress(". $_SESSION['idUser'] .")");

$totalOrder = 0;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="./style/style.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://www.paypal.com/sdk/js?client-id=Aaz8e_zzV1MWYPYCXmeTONvXAovD3v6nybKED7L4tXeOxTsgv8GuZfLAUjFeEdYjur7zpR8Ox-zCrhXi&disable-funding=card&currency=EUR"></script>
    <script type="text/javascript" src="./js/paypal.js"></script>
    <title>Paiement</title>
</head>
<body>
    <div class="rounded shadow main-block">
        <div class="basket-preview">
            <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="currentColor" class="bi bi-basket-fill" viewBox="0 0 16 16">
                <path d="M5.071 1.243a.5.5 0 0 1 .858.514L3.383 6h9.234L10.07 1.757a.5.5 0 1 1 .858-.514L13.783 6H15.5a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5H15v5a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V9H.5a.5.5 0 0 1-.5-.5v-2A.5.5 0 0 1 .5 6h1.717L5.07 1.243zM3.5 10.5a.5.5 0 1 0-1 0v3a.5.5 0 0 0 1 0v-3zm2.5 0a.5.5 0 1 0-1 0v3a.5.5 0 0 0 1 0v-3zm2.5 0a.5.5 0 1 0-1 0v3a.5.5 0 0 0 1 0v-3zm2.5 0a.5.5 0 1 0-1 0v3a.5.5 0 0 0 1 0v-3zm2.5 0a.5.5 0 1 0-1 0v3a.5.5 0 0 0 1 0v-3z"/>
            </svg>
            <p></p>
            <h3>Contenu de votre panier :</h3>
            <ul class="shadow list-group">
            <?php
                foreach ($basketProducts as $basketProduct) {
                    ?>
                        <li class="list-group-item">
                            Nom du produit : <?= $basketProduct['productName'] ?></br>
                            Quantité : <?= $basketProduct['quantity'] ?></br>
                            Prix : <?= number_format($basketProduct['price'] * $basketProduct['quantity'],2,',',' ') .'€'; ?>
                        </li>
                    <?php
                    $totalOrder += $basketProduct['price'] * $basketProduct['quantity'];
                }
            ?>
            </ul>
            <p></p>
            <h5>Total de votre commande (TTC) : </h5>
            <i id="sum"> <?= number_format($totalOrder * 1.2,2,',',' ') .'€'; ?> </i>
        </div>
        <div class="payment-methods">
            <h3>Moyen de paiement</h3>
            <p>
                Pour l'instant le site Dendō jitensha ne propose qu'un seul
                moyen depaiement sur son site. La solution choisie est PayPal.
                Pratique et facile à utiliser, cette solution vous permet
                d'effectuer vos achats sans entrer vos identifiants de cartes
                de crédits.
                <b>
                    Une fois validée, votre commande sera expediée à l'adresse
                    que vous avez indiquée dans votre espace personnel.
                    C'est pourquoi il est impératif que l'adresse postal que vous
                    avez indiquée soit à jour.
                </b>
                Pour effectuer le paiement de votre commande, veuillez
                cliquer sur le bouton ci-dessous.
            </p>
            <?php
                if ($addressInformations->fetch() !== false) {
                    if ($totalOrder > 0) {  
                        ?>
                            <div id="paypal-button-container"></div>
                        <?php
                    } elseif ($totalOrder === 0) {
                        ?>
                            <div class="alert alert-danger" role="alert">
                                Votre panier est vide !
                            </div>
                        <?php
                    }
                } else {
                    ?>
                        <div class="alert alert-danger" role="alert">
                            Aucune adresse n'est associée à votre compte !
                        </div>
                        <a href="../Profil/profil.php">Accéder à mon profil</a>
                        <p></p>
                    <?php
                }
            ?>
            <p>
                Si vous voulez abandonner la validation de votre panier et
                retourner sur notre site, vous pouvez cliquer sur ce lien :
                <a href="../index.php">Retourner sur le magasin</a>
            </p>
        </div>
    </div>
</body>
</html>