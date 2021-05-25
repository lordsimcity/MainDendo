<?php

namespace Basket\BasketClass\Database;

use PDO;
use DatabaseInformations\DbInformations;

/* 
* Si l'utilisateur est connecté à son espace utilisateur, c'est via cette classe que la gestion
* du panier s'effectue.
*/
class DbManager {

    private $_dbConnection;

    public function __construct($dbInformations) {
        
        $this->_dbConnection = $dbInformations;

    }

    public function query($query,$value = array()) {

        $db = $this->_dbConnection->prepare($query);
        $db->execute($value);
        
        return $db->fetchAll(PDO::FETCH_ASSOC);

    }

    public function add(array $data,$fk_idUser) {

        $db = $this->_dbConnection;

        $check = $db->prepare("CALL SelectBasket(:productName,:fk_idUser)");
        $check->bindValue(":productName",$data[0]['name_product']);
        $check->bindValue(":fk_idUser",$fk_idUser);

        $check->execute();

        $res = $check->fetch(PDO::FETCH_ASSOC);

        $check->closeCursor();

        if ($res == null) {
            $tmpRes = $db->prepare("CALL AddToBasket(:productName,:description,:quantity,:price,:fk_idUser,:id_product,:id_type_product)");
            $tmpRes->bindValue(":productName",$data[0]['name_product']);
            $tmpRes->bindValue(":description",$data[0]['description_product']);
            $tmpRes->bindValue(":quantity", 1);
            $tmpRes->bindValue(":price",$data[0]['price_product']);
            $tmpRes->bindValue(":fk_idUser",$fk_idUser);
            $tmpRes->bindValue(":id_product",$data[0]['id_product']);
            $tmpRes->bindValue(":id_type_product",$data[0]['id_type_product']);

            $tmpRes->execute();

            $tmpRes->closeCursor();
        } else {

            $res['quantity'] += 1;

            $tmpRes = $db->prepare("CALL UpdateUserBasket(:quantity,:productName,:fk_idUser)");
            $tmpRes->bindValue(":quantity",$res['quantity']);
            $tmpRes->bindValue(":productName",$data[0]['name_product']);
            $tmpRes->bindValue(":fk_idUser",$fk_idUser);

            $tmpRes->execute();

            $tmpRes->closeCursor();

        }
        
        $this->decreaseStock($data[0]['id_product']);

    }

    public function del($productName,$fk_idUser,$id_product) {

        $tmpDb = new DbInformations();
        $db = $tmpDb->getDbInformations();

        $getBasketInformations = $db->prepare("CALL SelectBasketProductQuantity(:productName,:fk_idUser)");
        $getBasketInformations->bindValue(":productName",$productName);
        $getBasketInformations->bindValue(":fk_idUser",$fk_idUser);
        $getBasketInformations->execute();
        $quantity = $getBasketInformations->fetch(PDO::FETCH_ASSOC);

        $getBasketInformations->closeCursor();

        $secondDb = $this->_dbConnection;
        $tmpRes = $secondDb->prepare("CALL DeleteProductFromBasket(:productName,:fk_idUser)");
        
        $tmpRes->bindValue(":productName",$productName);
        $tmpRes->bindValue(":fk_idUser",$fk_idUser);
        
        $tmpRes->execute();
        
        $tmpRes->closeCursor();
        
        $this->increaseStock($id_product,$quantity);

    }

    private function decreaseStock($id_product) {

        $tmpDb = new DbInformations();
        $db = $tmpDb->getDbInformations();

        $getProductInformations = $db->query("CALL SelectStock(". $id_product .")");
        $tmpStock = $getProductInformations->fetch(PDO::FETCH_ASSOC);

        $stock = $tmpStock;

        $getProductInformations->closeCursor();
        
        $updateStock = $db->prepare("CALL UpdateProductStock(:newStock,:id_product)");
        $updateStock->bindValue(":newStock", $stock['stock'] - 1);
        $updateStock->bindValue(":id_product", $id_product);
        $updateStock->execute();

        $updateStock->closeCursor();

    }

    private function increaseStock($id_product,$quantity) {

        $tmpDb = new DbInformations();
        $db = $tmpDb->getDbInformations();

        $getProductInformations = $db->query("CALL SelectStock(" . $id_product .")");
        $tmpStock = $getProductInformations->fetch(PDO::FETCH_ASSOC);

        $stock = $tmpStock;

        $getProductInformations->closeCursor();
        
        $updateStock = $db->prepare("CALL UpdateProductStock(:newStock,:id_product)");
        $updateStock->bindValue(":newStock", $stock['stock'] + $quantity['quantity']);
        $updateStock->bindValue(":id_product", $id_product);
        $updateStock->execute();

        $updateStock->closeCursor();

    }

}
