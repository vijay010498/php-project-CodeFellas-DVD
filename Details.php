<?php
require_once("Queries.php");
class Details extends Queries
{
    public function __construct()
    {
        parent::__construct();
    }
    public function dvdDetails($dvd_id)
    {  
        return $this->getDVDOne($dvd_id);        
    }
}


?>