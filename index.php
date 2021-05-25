<?php

session_start();

require_once "./Panier/vendor/autoload.php";
require_once "./main_backend/vendor/autoload.php";

use Basket\BasketClass\Database\DbManager;
use DatabaseInformations\DbInformations;

$tmpDb = new DbInformations();
$db = $tmpDb->getDbInformations();
$dbConnection = new DbManager($db);

$products = $dbConnection->query("CALL SelectAllProducts()");

?>

<!DOCTYPE html>

<html lang="fr" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="CSS/StyleHeaderFooter.css">
    <link rel="stylesheet" href="CSS/StyleIndex.css">
    <title>Accueil</title>
</head>
<body>
    <div class="container-fluid p-0">
        
        <?php require_once "main_backend/HeaderFooter/Header.php"; ?>

        <div class="row">
            <div class="col">
                <!-- Carousel affichant les "banderoles" d'annonces -->
                <div id="small_misc_carousel">
                    <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="Images/vignette_1.png" class="d-block w-100">
                            </div>
                            <div class="carousel-item">
                                <img src="Images/vignette_2.png" class="d-block w-100">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <!-- Caroussel principal contenannt les grandes images produits ou infos importantes -->
                <div id="main_carousel">
                    <div id="carouselExampleFade" class="carousel slide carousel-fade" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img class="d-block w-100" src="Images/carousel_1.jpg">
                            </div>
                            <div class="carousel-item">
                                <img class="d-block w-100" src="Images/carousel_2.jpg">
                            </div>
                            <div class="carousel-item">
                                <img class="d-block w-100" src="Images/carousel_3.jpg">
                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleFade" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleFade" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div id="headerProduits">
                <h2>Nos produits : </h2>
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-lg-2">

                <!-- box contenant les filtres -->
                <div id="filter_main">
                    <h3>Filtres : </h3>
                    <!-- Control buttons -->
                    <div id="myBtnContainer">
                        <button class="btn active" onclick="filterSelection('0')" value="0"> Tous</button>
                        <button class="btn" onclick="filterSelection('1')" value="1"> Vélos</button>
                        <button class="btn" onclick="filterSelection('2')" value="2"> Batteries</button>
                        <button class="btn" onclick="filterSelection('3')" value="3"> Selles</button>
                        <button class="btn" onclick="filterSelection('4')" value="4"> Accessoires</button>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-10 mt-2">
                <div class="row">
                <?php

                foreach($products as $product) {
                    ?>
                    <div class="col-12 col-lg-10 mt-2">
                        <div class="row">
                            <!-- partie contenant les produits, avec leur image, description et prix respectifs. -->
                            <div id="product">
                                <div class="filterDiv <?= $product['id_type_product']; ?>">
                                    <div class="content">
                                        <div class="card mb-3" style="max-width: 100%;">
                                            <div class="row no-gutters">
                                                <div class="col-md-4">
                                                    <?php $picturePath = "./main_backend/img/products/".$product["name_product"].".png";?>
                                                    <img src=<?=$picturePath?> class="card-img">
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="card-body">
                                                        <h5 class="card-title"><?= $product['name_product']; ?></h5>
                                                        <p class="card-text"><?= $product['description_product']; ?></p>
                                                        <p class="card-text"><?= number_format($product['price_product'],2,',',' ') .'€'; ?></p>
                                                        <?php
                                                            if ($product['stock'] > 0) {
                                                        ?>
                                                            <a class="nav-link active" href="./Panier/php/addToBasket.php?idProduct=<?= $product['id_product'] ?>">
                                                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-basket" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                                <path fill-rule="evenodd" d="M5.757 1.071a.5.5 0 0 1 .172.686L3.383 6h9.234L10.07 1.757a.5.5 0 1 1 .858-.514L13.783 6H15a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1v4.5a2.5 2.5 0 0 1-2.5 2.5h-9A2.5 2.5 0 0 1 1 13.5V9a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h1.217L5.07 1.243a.5.5 0 0 1 .686-.172zM2 9v4.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V9H2zM1 7v1h14V7H1zm3 3a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3A.5.5 0 0 1 4 10zm2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3A.5.5 0 0 1 6 10zm2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3A.5.5 0 0 1 8 10zm2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 1 .5-.5zm2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 1 .5-.5z"/>
                                                            </svg> 
                                                                Ajouter au panier
                                                            </a>
                                                        <?php 
                                                            } else {
                                                        ?>
                                                            <div class="alert alert-danger" style="width: 40%" role="alert">
                                                                Produit en rupture
                                                            </div>
                                                        <?php   
                                                            }

                                                            if(isset($_SESSION['userEmail'])) {
                                                                ?>
                                                                <a class="nav-link active" href="./Favoris/addToFavorites.php?idProduct=<?= $product['id_product'] ?>">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" class="bi bi-star" viewBox="0 0 16 16">
                                                                    <path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.523-3.356c.329-.314.158-.888-.283-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767l-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288l1.847-3.658 1.846 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.564.564 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z"/>
                                                                </svg>
                                                                    Ajouter aux favoris
                                                                </a>
                                                                <?php
                                                            }
                                                        ?>
                                                        <a class="nav-link active" href="./Produits/descriptionProduit.php?idProduct=<?=$product['id_product'];?>"> > Voir la fiche du produit </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                ?>
                </div>
            </div>
        </div>

        <?php require_once "main_backend/HeaderFooter/Footer.php"; ?>
        
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
<script type="text/javascript" src="Javascript/ScriptIndex.js"></script>
</html>
