<?php
require_once("Queries.php");
class UserOrders extends Queries
{
    public function __construct()
    {
        parent::__construct();
    }
    public function checkoutAndPlaceOrder($user_id)
    {
        return $this->createOrderAndClearCart($user_id);
    }
    
}




?>