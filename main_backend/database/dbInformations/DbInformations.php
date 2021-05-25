<?php

namespace DatabaseInformations;

use PDO;

class DbInformations {

    private $_dbInformations;

    public function __construct() {

    $this->_dbInformations = new PDO('mysql:host=localhost;dbname=Dendo_jitensha','iris1','password1'/*,array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8')*/);
        $this->_dbInformations->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

    }

    public function getDbInformations() {

        return $this->_dbInformations;

    }

}
