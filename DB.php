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
                address VARCHAR(255) NOT NULL,
                phoneNumber VARCHAR(12) NOT NULL,
                userType INT 
            )
        ");  // userType =  0 =  customer, 1 = Admin

        // Genres Table
        $this->pdoConnection->query("
            CREATE TABLE IF NOT EXISTS Genres(
                GenreId INT AUTO_INCREMENT PRIMARY KEY,
                genreName VARCHAR(15) NOT NULL
            )
        ");

        // DVDs Table
        $this->pdoConnection->query("
            CREATE TABLE IF NOT EXISTS DVDS(
                DVDId INT AUTO_INCREMENT PRIMARY KEY,
                Title VARCHAR(255) NOT NULL,
                GenreId INT NOT NULL,
                Price DECIMAL(10, 2) NOT NULL,
                StockQuantity INT DEFAULT 0,
                imageURL varchar(255),
                FOREIGN KEY (GenreId) REFERENCES Genres(GenreId)        
            )
        ");


        // Orders Table
        $this->pdoConnection->query("
            CREATE TABLE IF NOT EXISTS Orders(
                OrderId INT AUTO_INCREMENT PRIMARY KEY,
                UserId INT NOT NULL,
                orderDate DATETIME NOT NULL ,
                totalAmount DOUBLE NOT NULL,
                FOREIGN KEY (UserId) REFERENCES Users(UserId)
            )
        ");


        // orderItems Table
        $this->pdoConnection->query("
            CREATE TABLE IF NOT EXISTS OrderItems(
                OrderItemId INT AUTO_INCREMENT PRIMARY KEY,
                OrderId INT NOT NULL ,
                DVDId INT NOT NULL,
                quantity INT,
                subTotal DOUBLE,
                FOREIGN KEY (OrderId) REFERENCES Orders(OrderId),
                FOREIGN KEY (DVDId) REFERENCES DVDS(DVDId)
            )
        ");

        // Reviews Table
        $this->pdoConnection->query("
            CREATE TABLE IF NOT EXISTS Reviews(
                ReviewId INT AUTO_INCREMENT PRIMARY KEY ,
                DVDId INT NOT NULL,
                UserId INT NOT NULL,
                Rating DOUBLE NOT NULL,
                Comment VARCHAR(500),
                ReviewDate DATETIME,
                FOREIGN KEY (UserId) REFERENCES Users(UserId),
                FOREIGN KEY (DVDId) REFERENCES DVDS(DVDId)
            )
        ");


        // CartItems Table
        $this->pdoConnection->query("
            CREATE TABLE IF NOT EXISTS CartItems(
                CartItemId INT AUTO_INCREMENT PRIMARY KEY,
                UserId INT NOT NULL,
                DVDId INT NOT NULL,
                Quantity INT NOT NULL,
                Price DECIMAL(10, 2) NOT NULL,
                TotalPrice DECIMAL(10, 2) NOT NULL,
                FOREIGN KEY (UserId) REFERENCES Users(UserId),
                FOREIGN KEY (DVDId) REFERENCES DVDS(DVDId)
            )
        ");


    }

    public function getConnection()
    {
        return $this->connection;
    }

}