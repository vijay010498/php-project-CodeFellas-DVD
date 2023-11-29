<?php
require_once("DB.php");
class Queries extends DB
{
    public function __construct() {
        parent::__construct();
    }


    public function signUpUser($firstName, $lastName, $email, $password, $address, $phoneNumber) {
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

    public function signInUser($email, $password) {
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
}