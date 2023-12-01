<?php

require_once("Queries.php");

class Home extends Queries
{
    public function __construct()
    {
        parent::__construct();
    }

    public function fetchValues()
    {
        
        $this->getDVD();
        // return parent::getDVD();
       
    }

}
// //creating object for Home class to call the fetchValues function
$home = new Home();
$home->fetchValues();
?>