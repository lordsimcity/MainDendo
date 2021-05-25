<?php

session_start();

require_once "../main_backend/vendor/autoload.php";

use DatabaseInformations\DbInformations;
use EmailsSending\Emails;

$tmpDb = new DbInformations();
$db = $tmpDb->getDbInformations();

$addressInformations = $db->query("CALL GetUserAddress(". $_SESSION['idUser'] .")");
$tmpAddressInformations = $addressInformations->fetch(PDO::FETCH_ASSOC);

$fullAddressFormatting = $tmpAddressInformations['number'] . " " . $tmpAddressInformations['street'] . " " . $tmpAddressInformations['city'] . " " . $tmpAddressInformations['postal_code'];

$addressInformations->closeCursor();

date_default_timezone_set("Europe/Paris");
$date = date("Y-m-d H:i:s");

$tmpBasketContent = $db->query("CALL GetBasket(" . $_SESSION['idUser'] .")");

$tmpAmount = 0;

while ($basketContent = $tmpBasketContent->fetch(PDO::FETCH_ASSOC)) {

    $tmpAmount += $basketContent['price'] * $basketContent['quantity'];

}

$tmpBasketContent->closeCursor();

$amount = round($tmpAmount * 1.2,2);

$storageBillingInformation = $db->prepare("CALL AddOrder(:id_user,:order_status,:date_created_order,:date_modified_order,:amount_order,:numberadress_order,:streetadress_order,:cityadress_order,:postalcode_order,:firstname_bill,:lastname_bill,:adress_bill,:amount_bill)");
$storageBillingInformation->bindValue(':id_user', $_SESSION['idUser']);
$storageBillingInformation->bindValue(':order_status', 'Validated');
$storageBillingInformation->bindValue(':date_created_order', $date);
$storageBillingInformation->bindValue(':date_modified_order', $date);
$storageBillingInformation->bindValue(':amount_order', $amount);
$storageBillingInformation->bindValue(':numberadress_order', $tmpAddressInformations['number']);
$storageBillingInformation->bindValue(':streetadress_order', $tmpAddressInformations['street']);
$storageBillingInformation->bindValue(':cityadress_order', $tmpAddressInformations['city']);
$storageBillingInformation->bindValue(':postalcode_order', $tmpAddressInformations['postal_code']);
$storageBillingInformation->bindValue(':firstname_bill', $_SESSION['firstName']);
$storageBillingInformation->bindValue(':lastname_bill', $_SESSION['lastName']);
$storageBillingInformation->bindValue(':adress_bill', $fullAddressFormatting);
$storageBillingInformation->bindValue(':amount_bill', $amount);

$storageBillingInformation->execute();
$storageBillingInformation->closeCursor();

$tmpOrderInformations = $db->query("CALL SpecificUserOrder(". $_SESSION['idUser'] .",\"". $date ."\")");

$orderInformations = $tmpOrderInformations->fetch(PDO::FETCH_ASSOC);

$tmpOrderInformations->closeCursor();

$getOrderLineInformations = $db->query("CALL GetBasket(". $_SESSION['idUser'] .")");

$tmpOrderLineInformations = [];

while ($data = $getOrderLineInformations->fetch()) {

    array_push($tmpOrderLineInformations,$data);

}

$getOrderLineInformations->closeCursor();

$tableFormatting = '<table><tr><th>Nom du produit</th><th>Prix unitaire (TTC)</th><th>Quantité</th><th>Prix total (TTC)</th></tr>';

foreach ($tmpOrderLineInformations as $orderLine) {

    $tableFormatting .= '<tr><td>' . $orderLine['productName'] . '</td><td>' . round($orderLine['price']*1.2,2) . ' €</td><td>' . $orderLine['quantity'] . '</td><td>' . round($orderLine['price']*1.2,2) * $orderLine['quantity'] . ' €</td></tr>';

    $storageOrderLine = $db->prepare("CALL AddNewOrderLine(:user_id,:order_id,:date_created_order_line,:date_modified_order_line,:id_type_product,:id_product,:productName,:unitPrice,:totalPrice,:quantity)");
    $storageOrderLine->bindValue(":user_id",$_SESSION['idUser']);
    $storageOrderLine->bindValue(":order_id",$orderInformations['id_order']);
    $storageOrderLine->bindValue(":date_created_order_line",$date);
    $storageOrderLine->bindValue(":date_modified_order_line",$date);
    $storageOrderLine->bindValue(":id_type_product",$orderLine['id_type_product']);
    $storageOrderLine->bindValue(":id_product",$orderLine['id_product']);
    $storageOrderLine->bindValue(":productName",$orderLine['productName']);
    $storageOrderLine->bindValue(":unitPrice",round($orderLine['price']*1.2,2));
    $storageOrderLine->bindValue(":totalPrice",round($orderLine['price']*1.2,2) * $orderLine['quantity']);
    $storageOrderLine->bindValue(":quantity",$orderLine['quantity']);

    $storageOrderLine->execute();
    $storageOrderLine->closeCursor();
}

$tableFormatting .= '</table>';

$tmpOrderLineInformations = [];

$emailObject = "Facture n°" . $orderInformations['id_order'];

$message = 
'<h3>Bonjour ' . $_SESSION['firstName'] . ' ' . $_SESSION['lastName'] . ',</h3>
<p> 
    Veuillez trouver ci-dessous le récapitulatif de votre commande, passée à 
    la date suivante : <b>' . $date . '</b>.
</p>
<p>Facture numéro <b>' . $orderInformations['id_order'] . '</b> : </p>
' . $tableFormatting . '
<p></p>
<table>
    <tr>
        <th>Prox total de la commande</th>
    </tr>
    <tr>
        <td>' . $amount . ' €</td>
    </tr>
</table>
<p><b>
    Cet email fait office de justificatif de votre commande. Prenez
    donc soin de sauvegarder une copie de ce dernier, il sera à présenter
    obligatoirement en cas de problème.
</b></p>
<div class="spacer">
</div>
<p style="text-align: center;">L\'équipe support et clientèle de Dendō jitensha</p>';

$sendBill = new Emails($_SESSION['userEmail'],$emailObject,$message);
$sendBill->sendAnEmail();

$emptyBasket = $db->query("CALL DeleteSpecificBasket(". $_SESSION['idUser'] .")");

header("location:../index.php");
