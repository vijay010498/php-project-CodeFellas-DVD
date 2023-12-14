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
        return $this->getDVDs();
    }


    public function fetchGenres()
    {
        return $this->getGenres();
    }

}
?>