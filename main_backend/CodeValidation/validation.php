<?php

session_start();

if (isset($_POST['validationCode'])) {

    $code = htmlspecialchars($_POST['validationCode']);
    if ($code == $_SESSION['checkCode']) {
        unset($_SESSION['checkCode']);

        $_SESSION['idUser'] = htmlspecialchars($_GET['idUser']);
        $_SESSION['lastName'] = htmlspecialchars($_GET['lastName']);
        $_SESSION['firstName'] = htmlspecialchars($_GET['firstName']);
        $_SESSION['userEmail'] = htmlspecialchars($_GET['userEmail']);

        header("location:../../Profil/profil.php");
    } else {
        unset($_SESSION['checkCode']);
        ?>
            <!DOCTYPE html>
            <html lang="fr">
            <head>
                <meta charset="UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
                <title>Erreur - code invalide</title>
            </head>
            <body>
                <div class="alert alert-danger" role="alert">
                    Le code renseigné n'est pas valide, il ne correpond pas au code qui vous a été envoyé.
                </div>
                <p></p>
                <a href="../../index.php"> > Réessayer </a>
            </body>
            </html>
        <?php
    }

}