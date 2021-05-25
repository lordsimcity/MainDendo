<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="./style/style.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="./js/script.js" async></script>
    <script type="text/javascript" src="./js/email.js" async></script>
    <title>Mot de passe oublié</title>
</head>
<body>
    <div class="rounded shadow main-block">
        <h5> Formulaire de changement de mot de passe : </h5>
        <p></p>
        <div>
            <p>
                Veuillez renseigner l'adresse email que vous avez utilisez
                au moment de la création de votre compte :
            </p>
            <input type="email" class="form-control user-email" name="userEmail">
        </div>
        <p></p>
        <button type="submit" class="btn btn-primary validation-button">Envoyer</button>
        <p></p>
        <div class="is-registered">
            <div class="alert alert-success" role="alert">
                L'adresse email indiquée ci-dessus est bien liée à un compte.
            </div>
            <button type="button" class="btn btn-secondary send-an-email">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16">
                    <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2zm13 2.383l-4.758 2.855L15 11.114v-5.73zm-.034 6.878L9.271 8.82 8 9.583 6.728 8.82l-5.694 3.44A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.739zM1 11.114l4.758-2.876L1 5.383v5.73z"/>
                </svg>
            </button>
            M'envoyer un email pour changer mon mot de passe.
        </div>
        <div class="change-user-password">
            <p>
                Veuillez renseigner le code validation envoyé par email 
                (pour valider appuyer sur Entrée) :
            </p>
            <input type="text" class="form-control user-code-validation" name="userValidationCode">
            <div class="change-user-password-form">
                <form action="changePasswordTreatment.php" method="POST">
                    <div class="mb-3">
                        <label for="changePassword" class="form-label">Veuillez entrer votre nouveau mot de passe :</label>
                        <input type="password" class="form-control changePassword" id="changePassword" name="changePassword">
                    </div>
                    <div class="mb-3">
                        <label for="changePasswordCheck" class="form-label">Entrer une seconde fois votre nouveau mot de passe :</label>
                        <input type="password" class="form-control changePasswordCheck" id="changePasswordCheck" name="changePasswordCheck">
                    </div>
                    <button type="submit" class="btn btn-primary">Envoyer</button>
                </form>
            </div>
        </div>
        <div class="is-not-registered">
            <div class="alert alert-danger" role="alert">
                L'adresse renseignée n'est liée à aucun compte utilisateur !
            </div>
        </div>
    </div>
</body>
</html>