<?php

namespace Basket\BasketClass\BasketHandling;

/* 
* Lorsque les données sont stockées uniquement en session, donc que l'utilisateur n'a pas de compte ou n'est
* pas connecté, c'est via cette classe que la gestion du panier s'effectue.
*/

class BasketManager {

    private $_dbConnection;

    public function __construct($dbConnection) {

        if(!isset($_SESSION)) {

            session_start();

        }
        
        if(!isset($_SESSION['basket'])) {

            $_SESSION['basket'] = [];

        }

        $this->_dbConnection = $dbConnection;

    }

    public function total() {
        
        $total = 0;

        $tmpIds = array_keys($_SESSION['basket']);
        $ids = implode(",",$tmpIds);

        if (empty($ids)) {
            $products = array();
        } else {
            $products = $this->_dbConnection->query("SELECT id_product,price_product FROM Products WHERE id_product IN (".$ids.")");
        }

        foreach ($products as $product) {
            $total += $product['price_product'] * $_SESSION['basket'][$product['id_product']];
        }

        return $total;

    }

    public function add($product_id) {
        if(isset($_SESSION['basket'][$product_id])) {
            $_SESSION['basket'][$product_id]++;
        } else {
            $_SESSION['basket'][$product_id] = 1;
        }
    }

    public function del($product_id) {
        unset($_SESSION['basket'][$product_id]);
    }

}