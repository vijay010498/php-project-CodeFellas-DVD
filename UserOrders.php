<?php
require_once("Queries.php");
class UserOrders extends Queries
{
    public function __construct()
    {
        parent::__construct();
    }
    public function userOrderPage($user_id)
    {
        return $this->saveOrdersintoDatabase($user_id);
    }
    
}




?>