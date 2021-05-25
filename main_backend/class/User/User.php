<?php

namespace DendoJitenshaBackend\User;

use Exception;

class User {

    private $_idUser;
    private $_lastName;
    private $_firstName;
    private $_userMail;
    private $_password;

    public function __construct(array $userInformations) {
        
        if (isset($userInformations)) {
            if (count($userInformations) == 4 || count($userInformations) == 5) {
                $this->hydrate($userInformations);
            }
        }

    }

    protected function hydrate(array $userInformations) : void {
        foreach ($userInformations as $key => $value) {
            $method = "set".ucfirst($key);
            if (method_exists($this,$method)) {
                $this->$method($value);
            }
        }
    }

    // ============ Setters ============

    protected function setIdUser($value) : void {
        $this->_idUser = $value;
    }

    protected function setLastName($value) : void {
        $this->_lastName = $value;
    }

    protected function setFirstName($value) : void {
        $this->_firstName = $value;
    }

    protected function setUserMail($value) : void {

        if (preg_match("#^[a-z0-9\._-]{2,}@{1}[a-z0-9_-]{2,}\.[a-z]{2,4}$#",$value)) {
            $this->_userMail = $value;
        } else {
            throw new Exception("Les informations renseignées dans le champ adresse email ne semblent pas valides !");
        }
    }

    public function setPassword($value) : void {
        if (isset($value)) {
            $this->_password = $value;
        }
    }

    // =================================

    // ============ Getters ============

    public function getIdUser() : int {
        return $this->_idUser;
    }

    public function getLastName() : string {
        return $this->_lastName;
    }

    public function getFirstName() : string {
        return $this->_firstName;
    }

    public function getUserMail() : string {
        return $this->_userMail;
    }

    public function getPassword() : string {
        return $this->_password;
    }

    // =================================

}