<?php
require_once("Queries.php");
class Checkout extends Queries
{
    public function __construct()
    {
        parent::__construct();
    }
    public function chekoutPage($user_id)
    {
        return $this->getCartItemsIntoCheckout($user_id);
       
    }
}
?>