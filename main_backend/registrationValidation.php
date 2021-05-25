<?php

require_once "./vendor/autoload.php";

use Registration\ReCaptcha;
use Registration\Informations\RegistrationInformations;
use Registration\DatabaseHandling\DatabaseManager;

use DatabaseInformations\DbInformations;

use EmailsSending\Emails;

if(!empty($_POST["g-recaptcha-response"])) {

    $code = htmlspecialchars($_POST["g-recaptcha-response"]);

    $reCaptcha = new ReCaptcha("6LcNVpIaAAAAAIQS5V-htaxXcWgqx2b9DgYOmQmt");

    if($reCaptcha->checkCode($code)) {
        // Les potentiels scripts envoyés sont rendus inoffensifs :
        $lastname = htmlspecialchars($_POST['lastname']);
        $firstname = htmlspecialchars($_POST['firstname']);
        $mail_address = htmlspecialchars($_POST['mail_address']);
        $password = htmlspecialchars($_POST['password']);
        $passwordVerify = htmlspecialchars($_POST['passwordVerify']);

        if ($password == $passwordVerify) {

            $dataList = [
                'lastname' => $lastname,
                'firstname' => $firstname,
                'mail_address' => $mail_address,
                'password' => $password
            ];

            // Informations de connexion à la base de données :
                $tmpDb = new DbInformations();
                $db = $tmpDb->getDbInformations();

                $dbConnection = new DatabaseManager($db);

            $registrationInformations = new RegistrationInformations($dataList);

            if (!$dbConnection->checksBeforeRegistration($registrationInformations->getMail_address())) {

                $dbConnection->addUser($registrationInformations);

                $emailContent =
                    '<h3>Bonjour ' . $firstname . ' ' . $lastname . ',</h3>
                    <p>
                        Ce message permet de tester l\'adresse email que vous avez renseignée au moment de votre
                        inscripiton.
                        Si vous pouvez visualiser ce message, cela indique que vous avez été correctement
                        inscrit au site Dendō jitensha et que votre profil a bien été enregistré dans notre
                        base de données.
                    </p>
                    <div class="spacer">
                    </div>
                    <p style="text-align: center;">L\'équipe support et clientèle de Dendō jitensha</p>';


                $emailPreparation = new Emails($mail_address,'Validation d\'inscription',$emailContent);
                $emailPreparation->sendAnEmail();

                echo "<script>alert(\"Vous avez bien été ajouté à notre base de données !\")</script>";
                        header("Refresh: 0;URL=../index.php");

            } else {
              echo "<script>alert(\"Vous avez déjà un espace personnel !\")</script>";
                      header("Refresh: 0;URL=../index.php");

            }

        } else {

            echo "<p>Les deux mots de passe renseignés ne sont pas identiques !!!</p>";
            echo "<a href=\"../Inscription/registration.html\"> > Retourner au formulaire d'inscription </a>";

        }
    } else {
        echo "<p>Erreur de validation du reCAPTCHA !</p>";
        echo "<a href=\"../Inscription/registration.html\"> > Retourner au formulaire d'inscription </a>";
    }

}
