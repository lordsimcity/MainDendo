<?php

session_start();

require_once "./vendor/autoload.php";
require_once "../main_backend/vendor/autoload.php";

use Basket\BasketClass\BasketHandling\BasketManager;
use Basket\BasketClass\Database\DbManager;

use DatabaseInformations\DbInformations;

$tmpDb = new DbInformations();
$db = $tmpDb->getDbInformations();

$dbConnection = new DbManager($db);
$basket = new BasketManager($db);

if (isset($_GET['del']) && isset($_GET['del1']) && isset($_GET['del2'])) {
    $dbConnection->del($_GET['del'],$_GET['del1'],$_GET['del2']);
}

if (isset($_GET['del3'])) {
    $basket->del($_GET['del3']);
}

// Si la session n'existe pas, on affiche les produits du panier stockés en session.
if(!isset($_SESSION['userEmail'])) {
    
    ?>

    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <link rel="stylesheet" href="../CSS/StyleHeaderFooter.css">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <title>Panier</title>
    </head>
    <body>  
    
        
        <div class="titre">Vos articles :</div>
        <?php

            // On récupère les indices présent dans la session qui a le nom 'basket'
            $tmpIds = array_keys($_SESSION['basket']);
            $ids = implode(",",$tmpIds);

            if (empty($ids)) {
                $products = array();
            } else {
                /* $products = $dbConnection->query("CALL SelectProduct(".$ids.")"); */
                $products = $dbConnection->query("SELECT * FROM Products WHERE id_product IN (".$ids.")");
            }
            /*
            * On sélectionne les informations des produits stockés en session et on affiche 
            * le tout :
            */
            foreach ($products as $product) {
                ?>
                
                    <div class="article_box">
                        <div class="card mb-3" style="max-width: 87%;">
                            <div class="row no-gutters">
                                <div class="col-md-4">
                                    <img
                                        <?php
                                            $picturePath = "../main_backend/img/products/".$product["name_product"].".png";
                                        ?>
                                    >
                                    <img src=<?=$picturePath?> alt=<?=$product["name_product"].".png"?> width="200px" class="card-img">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title"><a href="basket.php?del3=<?=$product['id_product'];?>"></a></h5>
                                        <p class="card-text">
                                        <h2> <?= $product['name_product']; ?> </h2>
                                            <p> <?= $product['description_product']; ?> </p>
                                            <p> Quantité : <?= $_SESSION['basket'][$product['id_product']]; ?></p>
                                                </p>
                                                <p class="card-text">
                                                <p>Prix : <?= number_format($product['price_product'],2,',',' ') .'€'; ?></p>
                                            </p>
                                        <a href="basket.php?del3=<?=$product['id_product'];?>"> <button class="btn-cart">Supprimer l'article</button> </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>  

                <?php
            }
        ?>
        
        <div class="sum_price">
                <hr>
                <div class="row no-gutters">
                    <div class=".col-sm-6 col-md-8">Total :</div>
                    <div class="col-6 col-md-4"><h2><?= number_format($basket->total(),2,',',' ') . '€'; ?></h2></div>
                </div>
                <hr class="center_ligne">  
                <div class="row no-gutters">
                    <div class=".col-sm-6 col-md-8">Total (TVA 20%) :</div>
                    <div class="col-6 col-md-4"><h2> <?= number_format($basket->total() * 1.2,2,',',' ') . '€'; ?></h2></div>
                </div>
                <hr>   
        </div>

        <div class="btn_validation_backMenu">
            <a class="backMenu" href="../index.php">Page produits </a>
        </div>
    
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    </body>
    </html>

    <?php
// Si la session existe, l'utilisateur possède donc un espace utilisateur et il est connecté.
} else {

    ?>

    <!DOCTYPE html>
        <html lang="fr">
        <head>
            <meta charset="UTF-8">
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
            <link rel="stylesheet" href="../CSS/StyleHeaderFooter.css">
            <link rel="stylesheet" type="text/css" href="css/style.css">
            <title>Panier</title>
        </head>
        <body> 
        <div class="head_bar">
        <div class="titre">Vos articles :</div>
        
        </div>   
            <div class="basket-content">

                <?php
                    /*
                    * Les informations affichés seront récupérées via la base de données
                    * (table Baskets).
                    */
                    $products = $dbConnection->query("CALL SelectUserBasket(". $_SESSION['idUser'] .")");
                    $price = 0;
                    foreach ($products as $product) {
                        ?>

                        <div class="article_box">
                        <div class="card mb-3" style="max-width: 87%;">
                            <div class="row no-gutters">
                                <div class="col-md-4">
                                    <img
                                        <?php
                                        $picturePath = "../main_backend/img/products/".$product["productName"].".png";
                                        ?>
                                    >
                                    <img src=<?=$picturePath?> alt=<?=$product["productName"].".png"?> width="200px" class="card-img">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title"><a href="basket.php?del2=<?=$product['id_product'];?>"></a></h5>
                                        <p class="card-text">
                                        <h2> <?= $product['productName']; ?> </h2>
                                            <p> <?= $product['description']; ?> </p>
                                            <p> Quantité : <?= $product['quantity']; ?></p>
                                                </p>
                                                <p class="card-text">
                                                <p>Prix : <?= number_format($product['price'] * $product['quantity'],2,',',' ') .'€'; ?></p>
                                                <?php $price += $product['price'] * $product['quantity']; ?>
                                            </p>
                                        <a href="basket.php?del=<?=$product['productName'];?>&amp;del1=<?=$product['fk_idUsers'];?>&amp;del2=<?=$product['id_product'];?>"> <button class="btn-cart">Supprimer l'article</button> </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> 
                </div>

                <?php
                     }
                ?>

                <div class="sum_price">
                    <hr>
                    <div class="row no-gutters">
                        <div class=".col-sm-6 col-md-8">Total :</div>
                        <div class="col-6 col-md-4"><h2><?= number_format($price,2,',',' ') . '€' ?></h2></div>
                    </div>
                    <hr class="center_ligne">  
                    <div class="row no-gutters">
                        <div class=".col-sm-6 col-md-8">Total (TVA 20%) :</div>
                        <div class="col-6 col-md-4"><h2> <?= number_format($price * 1.2,2,',',' ') .'€'; ?></h2></div>
                    </div>
                    <hr>   
                </div>
                            
            


                <div class="btn_validation_backMenu">
                    <a class="backMenu" href="../index.php">Page produits </a>
                    <a class="validation" href="../Paiement/paiement.php">Valider le Panier</a>
                </div>
                <div class="foot_bar"></div>   
            <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
        </body>
    </html>

    <?php

}
