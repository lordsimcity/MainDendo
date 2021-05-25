<?php

session_start();

require_once "../main_backend/vendor/autoload.php";

use DatabaseInformations\DbInformations;

if (isset($_GET['idProduct'])) {
    $_SESSION['idProduct'] = $_GET['idProduct'];
}

$tmpDb = new DbInformations();
$db = $tmpDb->getDbInformations();

$informations = $db->query("CALL ProductDescription(".$_SESSION['idProduct'].")");
$tmpResponse = $informations->fetch(PDO::FETCH_ASSOC);

$response = $tmpResponse;
$informations->closeCursor();

$comments = $db->query("CALL SelectComments(".$_SESSION['idProduct'].")");
$commentList = [];

while ($comment = $comments->fetch(PDO::FETCH_ASSOC)) {
    array_push($commentList, $comment);
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="./style.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous" async></script>
    <title> Fiche produit | <?= $response['name_product'] ?> </title>
</head>
<body>
    <div class="shadow product-information">
        <div class="shadow rounded product-picture">
            <?php $picturePath = "../main_backend/img/products/".$response['name_product'].".png";?>
            <img class="shadow-lg" src=<?=$picturePath?> alt=<?=$response['name_product']?> >
            <div class="user-interactions">
                <a class="btn btn-primary" href="../index.php">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-shop" viewBox="0 0 16 16">
                        <path d="M2.97 1.35A1 1 0 0 1 3.73 1h8.54a1 1 0 0 1 .76.35l2.609 3.044A1.5 1.5 0 0 1 16 5.37v.255a2.375 2.375 0 0 1-4.25 1.458A2.371 2.371 0 0 1 9.875 8 2.37 2.37 0 0 1 8 7.083 2.37 2.37 0 0 1 6.125 8a2.37 2.37 0 0 1-1.875-.917A2.375 2.375 0 0 1 0 5.625V5.37a1.5 1.5 0 0 1 .361-.976l2.61-3.045zm1.78 4.275a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 1 0 2.75 0V5.37a.5.5 0 0 0-.12-.325L12.27 2H3.73L1.12 5.045A.5.5 0 0 0 1 5.37v.255a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0zM1.5 8.5A.5.5 0 0 1 2 9v6h1v-5a1 1 0 0 1 1-1h3a1 1 0 0 1 1 1v5h6V9a.5.5 0 0 1 1 0v6h.5a.5.5 0 0 1 0 1H.5a.5.5 0 0 1 0-1H1V9a.5.5 0 0 1 .5-.5zM4 15h3v-5H4v5zm5-5a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1v-3zm3 0h-2v3h2v-3z"/>
                    </svg>
                    Retour vers la boutique
                </a>
                <p></p>
                <?php
                    if ($response['stock'] > 0) {
                       ?>
                            <a class="btn btn-primary" href="../Panier/php/addToBasket.php?idProduct=<?= $_SESSION['idProduct'] ?>">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-basket" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M5.757 1.071a.5.5 0 0 1 .172.686L3.383 6h9.234L10.07 1.757a.5.5 0 1 1 .858-.514L13.783 6H15a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1v4.5a2.5 2.5 0 0 1-2.5 2.5h-9A2.5 2.5 0 0 1 1 13.5V9a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h1.217L5.07 1.243a.5.5 0 0 1 .686-.172zM2 9v4.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V9H2zM1 7v1h14V7H1zm3 3a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3A.5.5 0 0 1 4 10zm2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3A.5.5 0 0 1 6 10zm2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3A.5.5 0 0 1 8 10zm2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 1 .5-.5zm2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 1 .5-.5z"/>
                                </svg> 
                                Ajouter au panier
                            </a>
                       <?php 
                    } else {
                        ?>
                            <button class="btn btn-primary" disabled>
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-basket" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M5.757 1.071a.5.5 0 0 1 .172.686L3.383 6h9.234L10.07 1.757a.5.5 0 1 1 .858-.514L13.783 6H15a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1v4.5a2.5 2.5 0 0 1-2.5 2.5h-9A2.5 2.5 0 0 1 1 13.5V9a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h1.217L5.07 1.243a.5.5 0 0 1 .686-.172zM2 9v4.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V9H2zM1 7v1h14V7H1zm3 3a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3A.5.5 0 0 1 4 10zm2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3A.5.5 0 0 1 6 10zm2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3A.5.5 0 0 1 8 10zm2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 1 .5-.5zm2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 1 .5-.5z"/>
                                </svg> 
                                Ajouter au panier
                            </button>
                        <?php 
                    }
                
                    if(isset($_SESSION['userEmail'])) {
                        ?>
                        <p></p>
                        <a class="btn btn-primary" href="../Favoris/addToFavorites.php?idProduct=<?= $_SESSION['idProduct'] ?>">
                            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" class="bi bi-star" viewBox="0 0 16 16">
                                <path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.523-3.356c.329-.314.158-.888-.283-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767l-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288l1.847-3.658 1.846 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.564.564 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z"/>
                            </svg>
                            Ajouter aux favoris
                        </a>
                        <p></p>
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Ajouter un commentaire
                        </button>

                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Ajouter un commentaire</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Ajouter un commentaire au produit possédant le nom <?=$response['name_product']?>.
                                        <form action="addComment.php" method="POST">
                                            <textarea class="form-control" name="userComment" rows="3"></textarea>
                                            <p></p>
                                            <button type="submit" class="btn btn-primary">Ajouter</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                ?>
            </div>
        </div>
        <div class="rounded shadow product-description">
            <div class="title">
                <h2><?=$response['name_product']?></h2>
                <!-- <p><?=$response['description_product']?></p> -->
                <p>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Veniam ut illum commodi. Saepe cumque nam dignissimos eaque aperiam, atque suscipit minima, ipsa, debitis fugiat nihil beatae rerum vel doloremque ex!
                </p>
            </div>
            <table class="table">
                <thead>
                    <tr class="table-dark">
                        <th scope="col">Autonomie</th>
                        <th scope="col">Moteur</th>
                        <th scope="col">Batterie</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="table-light">
                        <td><?= isset($response['autonomy']) ? $response['autonomy'] : "-" ?></td>
                        <td><?= isset($response['motor']) ?  $response['motor'] : "-" ?></td>
                        <td><?= isset($response['battery']) ? $response['battery'] : "-" ?></td>
                    </tr>
                </tbody>
                <thead>
                    <tr class="table-dark">
                        <th scope="col">Fabricant</th>
                        <th scope="col">Prix (TTC)</th>
                        <th scope="col">Stock</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="table-light">
                        <td><?= isset($response['brand']) ? $response['brand'] : "-" ?></td>
                        <td><?= number_format($response['price_product'] * 1.2,2,',',' ') ?>€</td>
                        <td>
                        <?php 
                            if ($response['stock'] > 0) {
                                echo $response['stock']; 
                            } else {
                                echo "En rupture";
                            }
                        ?>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="title">
                <p><b>Commentaires laissés par d'autres utilisateurs :</b></p>
            </div>
            <div class="comments">
                <?php
                    if (sizeof($commentList) === 0) {
                        echo "<p><b>Il n'y a pas encore de commentaires pour ce produit.<b></p>";
                    } else {
                        foreach ($commentList as $com) {
                            echo "<div class=\"rounded unitary-comment\">";
                                echo "<p><b>" . $com['username'] . "</b></p>";
                                echo "<p>" . $com['comment'] . "</p>";
                                echo "<p></p>";
                            echo "</div>";
                        }
                    }
                ?>
            </div>
        </div>
    </div>
</body>
</html>
