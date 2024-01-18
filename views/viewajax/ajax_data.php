<?php
    
        require_once '../../controller/PurchaseHistory_Control.php';
        $purchase = new PurchaseHistory_Control();
        $purchase -> getListPurchaseHistory();
    
   
?>