<?php

require_once "../Panier/vendor/autoload.php";
require_once "../main_backend/vendor/autoload.php";

use Basket\BasketClass\Database\DbManager;
use DatabaseInformations\DbInformations;


session_start();

if (!isset($_SESSION['idUser'])) {
    ?>
    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Favoris</title>
    </head>
    <body>
    </div>   
        <p>Veuillez vous connecter pour pouvoir ajouter un favoris !</p>
        <a href="../index.php"> > Retourner à l'accueil</a>
    </body>
    </html>
    <?php
} else {
    $tmpDb = new DbInformations();
    $db = $tmpDb->getDbInformations();
    $dbConnection = new DbManager($db);

    $favorites = $dbConnection->query("CALL SelectUserFavorite(".$_SESSION['idUser'].")");

    ?>
    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <link rel="stylesheet" href="../CSS/StyleHeaderFooter.css">
        <link rel="stylesheet" type="text/css" href="style_favoris.css">
        <title>Favoris</title>
    </head>
    <body>
    <div class="head_bar">
    <div class="titre">Favoris :</div>
        
    </div>   

        <?php
            foreach($favorites as $favorite) {
                $product = $dbConnection->query("CALL SelectProduct(". $favorite['id_product'] .")");
                
                $picturePath = "../main_backend/img/products/".$product[0]["name_product"].".png";
                ?>
                


                    <div class="article_box">
                        <div class="card mb-3" style="max-width: 87%;">
                            <div class="row no-gutters">
                                <div class="col-md-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                        <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.283.95l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                    </svg>
                                </div>
                                <div class="col-md-4">
                                    <img src=<?=$picturePath?> alt=<?=$product[0]["name_product"].".png"?> class="card-img">
                                </div>
                                <div class="col-md-6">
                                    <div class="card-body">
                                        <h5 class="card-title"><a href="basket.php?del2=<?=$product['id_product'];?>"></a></h5>
                                        <p class="card-text">
                                        <h2> <?= $product[0]['name_product']; ?> </h2>
                                            <p> <?= $product[0]['description_product']; ?> </p>
                                                <p class="card-text">
                                                <p>Prix : <?= number_format($product[0]['price_product'],2,',',' ') .'€'; ?></p>
                                            </p>
                                        <a href="favDelete.php?del1=<?=$product[0]['id_product'];?>"> <button class="btn-cart" type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-sm">Supprimer l'article</button> </a>
                                            
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>  

                <?php
            }
        ?>
        <div class="btn_validation_backMenu">
             <a href="../index.php"> <button class="backMenu" href="../index.php">Retourner à l'accueil</button></a>
         </div>
         <div class="foot_bar"></div>
    </body>
    </html>
    <?php
}
