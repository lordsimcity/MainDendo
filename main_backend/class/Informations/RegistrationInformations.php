<?php

namespace Registration\Informations;


/**
 * La classe RegistrationInformations permettra le stockage des informations de l'utilisteur qui
 * souhaite s'inscrire.
 */


class RegistrationInformations {

    // Attributs de la class
    private $_lastname;
    private $_firstname;
    private $_mail_address;
    private $_password;

    // Constructeur de la classe
    public function __construct(array $data) {

        $this->hydrate($data);

    }

    /* 
    * La fonction hydrate permet d'hydrater les attributs de la classe en appelant des méthodes 
    * par l'appel de méthodes spécialisées.
    */

    protected function hydrate(array $data) : bool {

        /*
        * Vérification du nombre d'informations passées en paramètre (doit être égal au nombre d'attribut).
        */
        if (count($data) == 4) {

            foreach($data as $key => $value) {

                $method = "set".ucfirst($key);
                
                if (method_exists($this,$method)) {
                    $this->$method($value);
                }

            }

            return true;

        } else {

            return false;

        } 

    }

    // Setters de la classe RegistrationInformations

    protected function setLastname($value) : void {

        if(is_string($value) && strlen($value) <= 45) {

            $this->_lastname = $value;

        }

    }

    protected function setFirstname($value) : void {

        if(is_string($value) && strlen($value) <= 45) {

            $this->_firstname = $value;

        }

    }

    protected function setMail_address($value) : void {

        if(is_string($value) && strlen($value) <= 45) {

            $this->_mail_address = $value;

        }

    }

    protected function setPassword($value) : void {

        if(is_string($value) && strlen($value) <= 16) {

            $this->_password = $value;

        }

    }

    // ==================================================

    // Getters de la classe RegistrationInformations

    public function getLastname() {

        return $this->_lastname;

    }

    public function getFirstname() {

        return $this->_firstname;

    }

    public function getMail_address() {

        return $this->_mail_address;

    }

    public function getPassword() {

        return $this->_password;

    }

    // ==================================================

}