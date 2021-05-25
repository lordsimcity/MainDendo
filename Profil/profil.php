<?php

  session_start();

  if (!isset($_SESSION['userEmail'])) {
    header("location:../Connexion/connexion.html");
  }

  require_once "../main_backend/vendor/autoload.php";

  use DatabaseInformations\DbInformations;

  $tmpDb = new DbInformations();
  $db = $tmpDb->getDbInformations();

  $address = $db->query("CALL GetUserAddress(".$_SESSION['idUser'].")");
  $addressInformations = $address->fetch();
?>

<!DOCTYPE html">
<html lang="fr">
  <head>
    <meta charset="utf-8" />
    <title>Profil</title>
    <link rel="stylesheet" type="text/css" href="./style_profil.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
  </head>
  
  <body>
  <div class="container">
    <div class="shadow-lg w-100 p-3 mb-5 bg-white rounded">
    <div class="d-flex justify-content-center position-relative mt-5">
          <img src="../Inscription/img/logo_dendo_jitensha.png" width="250px" alt="Dendō jitensha">
        </div>

        <p class="increase-font-size">Profil</p>
        <br>
        <div class="form-row">
          <div class="form-group col-md-2">
            <label for="firstname"><b>Nom :  </b><?php echo $_SESSION['lastName'] ?></label>
          </div>
          <div class="form-group col-md-10">
            <label for="lastname"><b>Prénom :  </b><?php echo $_SESSION['firstName'] ?> </label>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="inputEmail4"><b>Email : </b> <?php echo $_SESSION['userEmail'] ?></label>
          </div>
          <div class="form-group col-md-6">
          <button class="btn" onclick="toggleFormMail()">Changer votre addresse mail</button>
            <div id="formsMail" class="forms">
                <form action="profil_changes.php" method="POST">
                    <label for="pwd">Mot de passe :</label><br>
                    <input type="password" id="pwd" name="pwd"><br>
                    <label for="new_mail">Nouvelle addresse :</label><br>
                    <input type="email" id="new_mail" name="new_mail">
                    <p></p>
                    <button type="submit">Valider</button>
                    <a class="close-change-form" onclick="closeFormMail()">
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-square" viewBox="0 0 16 16">
                        <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                        <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                      </svg>
                      Fermer
                    </a>
                </form>
            </div>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="inputPassword4"><b>Mot de passe :</b> ******</label>
          </div>
          <div class="form-group col-md-6">
          <button class="btn" onclick="toggleFormPwd()">Changer votre mot de passe</button>
              <div id="formsMdp" class="forms">
                  <form action="profil_changes.php" method="POST">
                      <label for="pwd">Mot de passe actuelle :</label><br>
                      <input type="password" id="pwd" name="pwd"><br>
                      <label for="new_pwd">Nouveau mot de passe :</label><br>
                      <input type="password" id="new_pwd" name="new_pwd"><br>
                      <label for="tewt_new_pwd">Réécrire le nouveau mot de passe :</label><br>
                      <input type="password" id="new_pwd_check" name="new_pwd_check">
                      <p></p>
                      <button type="submit">Valider</button>
                      <a class="close-change-form" onclick="closeFormPwd()">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-square" viewBox="0 0 16 16">
                          <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                          <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                        </svg>
                        Fermer
                      </a>
                  </form>
              </div>
          </div>
        </div>
        
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="inputPassword4"> <b>Adresse de livraison : </b></label></br>
            <?php

              if($addressInformations !== false) {

                echo "Adresse : " . $addressInformations[2] . " " . $addressInformations[3] . "</br>";
                echo "Ville : " . $addressInformations[4] . "</br>";
                echo "Code postal : " . $addressInformations[5] . "</br>";

                ?>  
      
          </div>
          <div class="form-group col-md-6">
          <button class="btn" onclick="toggleFormAddress()">Modifier mon adresse postal</button>
        <div id="formsAddress" class="forms">
        <form action="profil_address.php?update=true" method="POST">
          <label for="number">Numéro</label><br>
          <input type="number" id="number" name="number"><br>
          <p></p>
          <label for="street">Rue</label><br>
          <input type="text" id="street" name="street"><br>
          <p></p>
          <label for="city">Ville</label><br>
          <input type="text" id="city" name="city"><br>
          <p></p>
          <label for="zipCode">Code postal</label><br>
          <input type="number" id="zipCode" name="zipCode"><br>
          <p></p>
          <button type="submit">Modifier l'adresse</button>
          <a class="close-change-form" onclick="closeFormAddress()">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-square" viewBox="0 0 16 16">
              <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
              <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
            </svg>
            Fermer
          </a>
        </form>
      </div>

        <?php

      } else {

        ?>

      <p>Aucune adresse n'a été associée à votre compte.</p>
      <button class="btn" onclick="toggleFormAddress()">Ajouter une adresse</button>
      <div id="formsAddress" class="forms">
        <form action="profil_address.php" method="POST">
          <label for="number">Numéro</label><br>
          <input type="number" id="number" name="number"><br>
          <p></p>
          <label for="street">Rue</label><br>
          <input type="text" id="street" name="street"><br>
          <p></p>
          <label for="city">Ville</label><br>
          <input type="text" id="city" name="city"><br>
          <p></p>
          <label for="zipCode">Code postal</label><br>
          <input type="number" id="zipCode" name="zipCode"><br>
          <p></p>
          <button type="submit">Ajouter l'adresse</button>
          <a class="close-change-form" onclick="closeFormAddress()">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-square" viewBox="0 0 16 16">
              <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
              <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
            </svg>
            Fermer
          </a>
        </form>
      </div>

        <?php

        }

        ?>
        </div>
    </div>
  
  <div class="footmenu">            
    <hr class="hr">
    <a href="../main_backend/logout.php">> Se déconnecter </a>
    <a href="./orderHistory/orderHistory.php">> Historique de commande </a>
    <a href="../Panier/basket.php">> Voir mon panier </a>
    <a href="../index.php">> Voir les produits </a>
  </div> 
</div>
</div> 
  </div>
    
  </body>
  <script src="script.js" type="text/javascript"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</html>