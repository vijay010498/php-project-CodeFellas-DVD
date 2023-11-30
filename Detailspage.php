<?php
require("DB.php");

class Details extends DB
{
    public function detailsPage($dvd_id)
    {

        $conn = $this->pdoConnection;

        // Check if a DVD ID is provided in the URL
        if (!empty($dvd_id )) {

            // Retrieve DVD details from the database
            $query = "SELECT * FROM DVDS WHERE DVDId = $dvd_id;";
            $results = $this->pdoConnection->query($query);
            $rows = $results->fetchAll(PDO::FETCH_ASSOC);

            // Check if the DVD data exists
            if (count($rows) > 0) {
                  // Return DVD details as JSON (you can modify this based on your needs)
                    header('Content-Type: application/json');
                    echo json_encode($rows, JSON_PRETTY_PRINT);
               
                exit();
            } 
            else {
                // DVD not found
                http_response_code(404);
                echo json_encode(array('error' => 'DVD not found'));
                exit();
            }
        } 
        else {
            // DVD ID not provided
            http_response_code(400);
            echo json_encode(array('error' => 'DVD ID not provided'));
            exit();
        }
    }
}
//creating object for Details class
$details = new Details();
if (!empty($_GET["DVDId"])) {
    $details->detailsPage($_GET["DVDId"]);
}
else{
    $details->detailsPage('');
}

?>