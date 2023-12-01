<?php
// require("DB.php");
require_once("Queries.php");
class Details extends Queries
{
    public function __construct()
    {
        parent::__construct();
    }
    public function detailsPage($dvd_id)
    {  
        $this->getDVDOne($dvd_id);        
    }
}
// //creating object for Details class
$details = new Details();
if (!empty($_GET["DVDId"])) {
    $details->detailsPage($_GET["DVDId"]);
}
else{
    $details->detailsPage('');
}

?>