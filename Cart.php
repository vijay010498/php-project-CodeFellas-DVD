<?php
require_once("Queries.php");
class Cart extends Queries
{

    public function __construct()
    {
        parent::__construct();
    }

    public function addDVDIntoCart($DVDId, $quantity)
    {
        $this->addItemIntoCart($DVDId, $quantity);
    }

    public function deleteDVDFromCart($cartId)
    {
        $this->removeCartItem($cartId);
    }
}