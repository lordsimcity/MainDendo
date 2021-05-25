<?php

session_start();

require_once '../vendor/autoload.php';

use EmailsSending\Emails;

$checkCode = random_int(100000, 999999);
$_SESSION['checkCode'] = $checkCode;

$idUser = htmlspecialchars($_GET['idUser']);
$lastName = htmlspecialchars($_GET['lastName']);
$firstName = htmlspecialchars($_GET['firstName']);
$userEmail = htmlspecialchars($_GET['userEmail']);

$emailContent = 
    '<h3>Bonjour ' . $firstName . ' ' . $lastName . ',</h3>
    <p> 
        Veuillez trouver ci-dessous le code de validation que vous devez renseigner dans la fenêtre de
        validation de connexion et ainsi accéder à votre espace personnel. 
    </p>
    <div class="code-container">
        ' . $checkCode . '
    </div>
    <p style="text-align: center;">L\'équipe support et clientèle de Dendō jitensha</p>';
        

$emailPreparation = new Emails($userEmail,'Validation de connexion',$emailContent);
$emailPreparation->sendAnEmail();

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style.css"></link>
    <title>Validation de connexion</title>
</head>
<body>
    <div class="rounded shadow-lg main-element">
        <div class="infos">
            <h2>Page de validation de connexion</h2>
            <p>
                <b>Procédure de validation de connexion : </b> Nous venons de vous envoyer un code à 6 chiffres par email.
                L'adresse email utilisée est celle que vous avez renseignée au moment de votre inscription.
                Pour valider votre connexion, veuillez renseigner le code envoyé dans le champ suivant.            
            </p>
        </div>
        <div class="form-block">
            <form action="./validation.php?idUser=<?=$idUser?>&lastName=<?=$lastName?>&firstName=<?=$firstName?>&userEmail=<?=$userEmail?>" method="POST">
                <div class="mb-3">
                    <label for="validationCode" class="form-label">Code de validation à 6 chiffres</label>
                    <input type="text" class="form-control" id="validationCode" name="validationCode" required>
                </div>
                <button type="submit" class="btn btn-primary">Envoyer</button>
            </form>
        </div>
    </div>
</body>
</html>
