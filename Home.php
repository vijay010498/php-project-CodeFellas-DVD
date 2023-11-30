<?php
require("DB.php");

class Home extends DB
{
    public function fetchValues()
    {
        //query to retrieve all data from DVD table
        $query = 'SELECT D.Title,D.Price,D.imageURL, Genres.genreName
        FROM DVDS AS D
        JOIN Genres ON D.GenreId = Genres.GenreId;';
        $results = $this->pdoConnection->query($query);
        $rows = $results->fetchAll(PDO::FETCH_ASSOC);
        // printing data in json format
        header('Content-Type: application/json');
        echo json_encode($rows, JSON_PRETTY_PRINT);
    }

}
//creating object for Home class to call the fetchValues function
$home = new Home();
$home->fetchValues();
?>