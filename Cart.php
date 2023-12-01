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
        return parent::addItemIntoCart($DVDId, $quantity);
    }

    public function deleteDVDFromCart($cartId)
    {
        return parent::removeCartItem($cartId);
    }

    public function getUsrCartItems()
    {
        return parent::getUserCartItems();
    }
}