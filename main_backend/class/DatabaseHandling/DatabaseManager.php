<?php

namespace Registration\DatabaseHandling;

use Registration\Informations\RegistrationInformations;

/**
 * La classe DatabaseManager permettra de manipuler les données présentes dans la BDD
 */

class DatabaseManager {

    private $_dbConnection;

    // Constructeur de la classe

    public function __construct($connectionInformations) {

        $this->_dbConnection = $connectionInformations;

    }

    // Méthode permettant de vérifier qu'un utilisateur n'a pas déjà crée un compte.

    public function checksBeforeRegistration($mail_address) : bool {
        
        $db = $this->_dbConnection;
        $tmpRes = $db->prepare("CALL SelectUser(:mail_address)");
        $tmpRes->bindValue(":mail_address",$mail_address);
        $tmpRes->execute();

        if ($tmpRes->fetch() != null) {

            $tmpRes->closeCursor();
            return true;

        } else {
            
            $tmpRes->closeCursor();
            return false;

        }

    }

    // Méthode permettant d'ajouter un compte utilisateur à la base de données.

    public function addUser(RegistrationInformations $data) : void {
        
        $db = $this->_dbConnection;

        // Étape avant ajout d'un utilisateur à la base de données -> "chiffrement" du mdp.
        $password = password_hash($data->getPassword(),PASSWORD_DEFAULT);

        date_default_timezone_set("Europe/Paris");
        $date = date("Y-m-d H:i:s");

        $tmpRes = $db->prepare("CALL AddUser(:lastname,:firstname,:mail_address,:password,:date_created_user,:date_modified_user)");
        $tmpRes->bindValue(":lastname",$data->getlastname());
        $tmpRes->bindValue(":firstname",$data->getFirstname());
        $tmpRes->bindValue(":mail_address",$data->getMail_address());
        $tmpRes->bindValue(":password",$password);
        $tmpRes->bindValue(":date_created_user",$date);
        $tmpRes->bindValue(":date_modified_user",$date);

        $tmpRes->execute();

        $tmpRes->closeCursor();

    }

}