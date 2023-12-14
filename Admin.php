<?php
require_once("Queries.php");

class Admin extends Queries
{
    public function __construct()
    {
        parent::__construct();
    }

    public function createNewDVD($Title, $GenreId, $Price, $stockQuantity, $imageURL,$description) {
        return $this->createDVD($Title, $GenreId, $Price, $stockQuantity, $imageURL,$description);
    }

    public function createNewGenre($genreName) {
        return $this->createGenre($genreName);
    }

    public function deleteDvd($DVDId) {
        return $this->deleteDVDs($DVDId);
    }

    public function updateDVDQunty($DVDId, $newQuantity) {
        return $this->updateDVDQuantity($DVDId, $newQuantity);
    }


}