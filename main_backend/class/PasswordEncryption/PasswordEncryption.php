<?php

namespace DendoJitenshaBackend\PasswordEncryption;

use Exception;

final class PasswordEncryption {

    private $_nonEncryptedPassword;
    private $_encryptedPassword;

    public function __construct($data) {
        
        if (isset($data)) {
            if (strlen($data) >= 8) {
                $this->_nonEncryptedPassword = $data;
                $this->encryption($data);
            } else {
                throw new Exception("Le mot de passe renseigné n'est pas valide ! 
                Il doit être composé d'au moins 8 caractères (les carcatères avec accents ne sont pas autorisé).");
            }
        }

    }

    private function encryption($passwordToEncrypt) : void {

        $encryption = password_hash($passwordToEncrypt, PASSWORD_DEFAULT);
        $this->_encryptedPassword = $encryption;

    }

    public function getPassword() : string {
        
        return $this->_encryptedPassword; 

    }

}