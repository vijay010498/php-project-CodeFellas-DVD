<?php
// require("DB.php");
require_once("Queries.php");
class UserOrders extends Queries
{
    public function __construct()
    {
        parent::__construct();
    }
    public function userOrderPage($user_id)
    {
        $this->saveOrdersintoDatabase($user_id);
    }
    
}
//creating object for Checkout class
$userorders = new UserOrders();
if (!empty($_GET["userId"])) {
    $userorders->saveOrdersintoDatabase($_GET["userId"]);
}
else{
    $userorders->saveOrdersintoDatabase('');
}



?>