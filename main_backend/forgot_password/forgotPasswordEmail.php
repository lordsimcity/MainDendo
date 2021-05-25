<?php

session_start();

require_once '../vendor/autoload.php';

use EmailsSending\Emails;

$userEmail = htmlspecialchars($_REQUEST['userEmail']);
$checkCode = random_int(100000, 999999);

$emailContent = 
    '<h3>Bonjour,</h3>
    <p> 
        Vous avez récemment demander à modifier votre mot de passe, 
        veuillez saisir le code ci-dessous de manière à pouvoir 
        changer ce dernier.
    </p>
    <div class="code-container">
        ' . $checkCode . '
    </div>
    <p style="text-align: center;">L\'équipe support et clientèle de Dendō jitensha</p>';
        

$emailPreparation = new Emails($userEmail,'Demande de modification de mot de passe',$emailContent);
$emailPreparation->sendAnEmail();

echo $checkCode;