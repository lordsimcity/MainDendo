<?php

namespace Connection\ConnectionVerif\DatabaseHandling;

use PDO;

class DatabaseManager {

    private $_dbConnection;

    // Constructeur de la classe

    public function __construct($connectionInformations) {

        $this->_dbConnection = $connectionInformations;

    }

    // Méthode permettant de vérifier qu'un utilisateur existe.

    public function checksBeforeConnection($userEmail) : bool {
        
        $db = $this->_dbConnection;
        $tmpRes = $db->prepare("CALL SelectUser(:mail_address)");
        $tmpRes->bindValue(":mail_address",$userEmail);
        $tmpRes->execute();

        if ($tmpRes->fetch() != null) {

            $tmpRes->closeCursor();
            return true;

        } else {

            $tmpRes->closeCursor();
            return false;

        }

    }

    // Méthode permettant de récupérer les inforamtions d'un utilisateur dans la base de données.

    public function getUserInformations($userEmail) : array {

        $db = $this->_dbConnection;
        $tmpRes = $db->prepare("CALL SelectUser(:mail_address)");
        $tmpRes->bindValue(":mail_address",$userEmail);
        $tmpRes->execute();

        $output = $tmpRes->fetch(PDO::FETCH_ASSOC);

        $listToUse = [];

        foreach($output as $key => $value) {
            $listToUse[$key] = $value;
        }

        return $listToUse;

    }

}