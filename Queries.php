<?php
require_once("DB.php");

class Queries extends DB
{
    public function __construct()
    {
        parent::__construct();
    }


    public function signUpUser($firstName, $lastName, $email, $password, $address, $phoneNumber)
    {
        try {

            if ($this->userExists($email)) {
                return false;
            }
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $sql = "INSERT INTO Users (firstName, lastName, email, password, address, phoneNumber, userType) VALUES (:firstName, :lastName, :email, :password,:address, :phoneNumber, 0)"; // 0 =  customer, 1 = Admin
            $stmt = $this->pdoConnection->prepare($sql);

            $stmt->bindParam(':firstName', $firstName);
            $stmt->bindParam(':lastName', $lastName);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $hashedPassword);
            $stmt->bindParam(':address', $address);
            $stmt->bindParam(':phoneNumber', $phoneNumber);

            return $stmt->execute();
        } catch (PDOException $e) {
            echo("signUpUser: " . $e->getMessage());
            return false;
        }
    }

    public function signInUser($email, $password)
    {
        try {
            $sql = "SELECT UserId, email, password, userType FROM Users WHERE email = ?";
            $stmt = $this->pdoConnection->prepare($sql);
            $stmt->execute([$email]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($password, $user['password'])) {

                // use Auth Manager
                AuthManager::loginUser($user['UserId'], $user['email'], $user['userType']);
                return true;
            } else {
                return false;
            }

        } catch (PDOException $e) {
            echo("signInUser: " . $e->getMessage());
            return false;
        }
    }

    private function userExists($email)
    {
        $sql = "SELECT COUNT(*) FROM Users WHERE email = ?";
        $stmt = $this->pdoConnection->prepare($sql);
        $stmt->execute([$email]);
        $count = $stmt->fetchColumn();

        return $count > 0;
    }

    protected function createDVD($Title, $GenreId, $Price, $stockQuantity, $imageURL)
    {
        try {
            // check for admin user
            if (!AuthManager::isAdmin()) {
                return false;
            }
            $sql = "INSERT INTO DVDS (Title, GenreId, Price, StockQuantity, imageurl) VALUES (:title, :genreId, :price, :stockQuantity,:imageURL)";
            $stmt = $this->pdoConnection->prepare($sql);
            $stmt->bindParam(':title', $Title);
            $stmt->bindParam(':genreId', $GenreId);
            $stmt->bindParam(':price', $Price);
            $stmt->bindParam(':stockQuantity', $stockQuantity);
            $stmt->bindParam(':imageURL', $imageURL);

            return $stmt->execute();

        } catch (PDOException $e) {
            echo("createDVD: " . $e->getMessage());
            return false;
        }
    }

    protected function deleteDVDs($DVDId) {
        try{
            // check for admin user
            if (!AuthManager::isAdmin()) {
                return false;
            }

            $sql = "DELETE FROM DVDS WHERE DVDId = :dvdId";
            $stmt = $this->pdoConnection->prepare($sql);
            $stmt->bindParam(':dvdId', $DVDId);

            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                return true;
            } else {
                return false;
            }

        }catch (PDOException $e) {
            echo("deleteDVD: " . $e->getMessage());
            return false;
        }
    }

    protected function updateDVDQuantity($DVDId, $newQuantity)
    {
        try {
            // Check for admin user
            if (!AuthManager::isAdmin()) {
                return false;
            }

            $sql = "UPDATE DVDS SET StockQuantity = :newQuantity WHERE DVDId = :dvdId";
            $stmt = $this->pdoConnection->prepare($sql);
            $stmt->bindParam(':newQuantity', $newQuantity, PDO::PARAM_INT);
            $stmt->bindParam(':dvdId', $DVDId, PDO::PARAM_INT);

            return $stmt->execute();
        } catch (PDOException $e) {
            echo("updateDVDQuantity: " . $e->getMessage());
            return false;
        }
    }


    private function getDVDDetails($DVDId)
    {
        try {
            $sql = "SELECT DVDId, Title, GenreId, Price, StockQuantity, imageURL FROM DVDS WHERE DVDId = ?";
            $stmt = $this->pdoConnection->prepare($sql);
            $stmt->execute([$DVDId]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo("getDVDDetails: " . $e->getMessage());
            return null;
        }
    }
    protected function addItemIntoCart($DVDId, $quantity) {
        try {
            $userId = AuthManager::getUserID();
            if (!$userId) {
                throw new ErrorException("User not logged in.");
            }

            $dvdDetails = $this->getDVDDetails($DVDId);
            if (!$dvdDetails) {
                throw new ErrorException("DVD not found.");
            }

            $sql = "INSERT INTO CartItems (UserId, DVDId, Quantity, Price, TotalPrice) VALUES (:userId, :DVDId, :quantity, :price, :totalPrice)";
            $stmt = $this->pdoConnection->prepare($sql);

            $price = $dvdDetails['Price'];
            $totalPrice = $price * $quantity;

            $stmt->bindParam(':userId', $userId);
            $stmt->bindParam(':DVDId', $DVDId);
            $stmt->bindParam(':quantity', $quantity);
            $stmt->bindParam(':price', $price);
            $stmt->bindParam(':totalPrice', $totalPrice);

            return $stmt->execute();

        }catch (PDOException $e) {
            echo("addIntoCart: " . $e->getMessage());
            return false;
        } catch (ErrorException $E) {
            echo($E->getMessage());
        }
    }

    protected function removeCartItem($cartId)
    {
        try {
            $userId = AuthManager::getUserID();
            if (!$userId) {
                throw new ErrorException("User not logged in.");
            }

            $deleteSql = "DELETE FROM CartItems WHERE CartItemId = :cartId AND UserId = :userId";
            $deleteStmt = $this->pdoConnection->prepare($deleteSql);
            $deleteStmt->bindParam(':cartId', $cartId);
            $deleteStmt->bindParam(':userId', $userId);
            $deleteStmt->execute();

            return $deleteStmt->rowCount() > 0;
        } catch (PDOException $e) {
            echo("removeCartItem: " . $e->getMessage());
            return false;
        } catch (ErrorException $E) {
            echo($E->getMessage());
        }
    }

}