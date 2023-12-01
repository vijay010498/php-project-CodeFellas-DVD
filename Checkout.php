<?php
// require("DB.php");
require_once("Queries.php");
class Checkout extends Queries
{
    public function __construct()
    {
        parent::__construct();
    }
    public function chekoutPage($user_id)
    {
        $this->getCartItemsIntoCheckout($user_id);
       
    }
}
$checkout = new Checkout();
if (!empty($_GET["userId"])) {
    $checkout->getCartItemsIntoCheckout($_GET["userId"]);
}
else{
    $checkout->getCartItemsIntoCheckout('');
}
?>