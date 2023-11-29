<?php


class DB
{
    private $host = "codefellas-dvd-store-codefellas.a.aivencloud.com";
    private $port = 27763;
    private $username = "avnadmin";
    private $password = "AVNS_QkZ9tl1tAlwh97S1O3D";
    protected $pdoConnection;


    public function __construct()
    {
        $this->connectAndInit();
    }

    private function connectAndInit()
    {
        $dbConnectionString = "mysql:host=$this->host;port=$this->port;charset=utf8mb4";

        try {
            $this->pdoConnection = new PDO($dbConnectionString, $this->username, $this->password);
            $this->pdoConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdoConnection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

            $dbName = "codeFellas";

            $this->createDatabase($dbName);


            $this->pdoConnection->query("USE $dbName");

            // init tables
            $this->initTables();
            echo "connected Successfully to $dbName";

        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    private function createDatabase($dbname)
    {
        $query = "CREATE DATABASE IF NOT EXISTS $dbname";
        $this->pdoConnection->exec($query);
    }

    private function initTables() {
        // users table
        $this->pdoConnection->query("
            CREATE TABLE IF NOT EXISTS Users (
              UserId INT AUTO_INCREMENT PRIMARY KEY,
                firstName VARCHAR(255) NOT NULL,
                lastName VARCHAR(255) NOT NULL,
                email VARCHAR(50) NOT NULL UNIQUE,
                password VARCHAR(255) NOT NULL,
                userType INT 
            )
        ");  // userType =  0 =  customer, 1 = Admin
    }

    public function getConnection()
    {
        return $this->connection;
    }

}