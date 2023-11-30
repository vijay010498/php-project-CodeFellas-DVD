<?php

class Admin extends Queries
{
    public function __construct()
    {
        parent::__construct();
    }

    public function createNewDVD($Title, $GenreId, $Price, $stockQuantity, $imageURL) {
        $this->createDVD($Title, $GenreId, $Price, $stockQuantity, $imageURL);
    }

    public function deleteDvd($DVDId) {
        $this->deleteDVDs($DVDId);
    }

    public function updateDVDQunty($DVDId, $newQuantity) {
        $this->updateDVDQuantity($DVDId, $newQuantity);
    }


}