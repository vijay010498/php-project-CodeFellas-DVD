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
    public function getDVD()
    {
       try{
         //query to retrieve all data from DVD table
         $query = 'SELECT D.Title,D.Price,D.imageURL, Genres.genreName
         FROM DVDS AS D
         JOIN Genres ON D.GenreId = Genres.GenreId;';
         $results = $this->pdoConnection->query($query);
         $rows = $results->fetchAll(PDO::FETCH_ASSOC);
        // return $rows; 
        if (count($rows)> 0 ) {
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
    } catch (PDOException $e) {
        echo("getDVDDetails: " . $e->getMessage());
        return null;
    }
    }

    public function getDVDOne($dvd_id)
    {
        try{
         // Retrieve DVD details from the database
         $query = "SELECT D.*, R.Rating, R.Comment, R.ReviewDate FROM DVDS AS D JOIN Reviews AS R ON D.DVDId = R.DVDId WHERE D.DVDId = ?";
         $results = $this->pdoConnection->prepare($query);
         $results->execute([$dvd_id]);
         $rows = $results->fetchAll(PDO::FETCH_ASSOC);
        //  return $rows;
          // Check if the DVD data exists
          if (count($rows) > 0 ) {
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
        } catch (PDOException $e) {
            echo("getDVDOneDetails: " . $e->getMessage());
            return null;
        }
    }

    public function getCartItemsIntoCheckout($user_id)
    {
        try {
         // Retrieve DVD details from the CartItem database
         $query = "SELECT * FROM CartItems WHERE userId = ?";
         $results = $this->pdoConnection->prepare($query);
         $results->execute([$user_id]);
         $rows = $results->fetchAll(PDO::FETCH_ASSOC);
         return $rows;
         // Check if a user ID is provided in the URL
        if (!empty($user_id )) {

            // Check if the user data exists
            if (count($rows) > 0) {
                  // Return DVD details as JSON (you can modify this based on your needs)
                    header('Content-Type: application/json');
                    echo json_encode($rows, JSON_PRETTY_PRINT);
                   
            } 
            else {
                // user not found
                http_response_code(404);
                echo json_encode(array('error' => 'Cart Item is empty'));
                exit();
            }
        } 
        else {
            // user ID not provided
            http_response_code(400);
            echo json_encode(array('error' => 'User ID not provided'));
            exit();
        }
        } catch (PDOException $e) {
            echo("getCartItemsIntoCheckout: " . $e->getMessage());
            return null;
        }
    
    }

    public function saveOrdersintoDatabase($user_id)
    {
        try {
        $cartItem = $this->getCartItemsIntoCheckout($user_id);
        if (!$cartItem) {
            throw new ErrorException("Cart is Empty.");
        }

        $totalPrice = 0;
        echo count($cartItem);
        // Loop through the array and add prices to the total
        for ($i = 0; $i < count($cartItem); $i++) {
            $totalPrice += $cartItem[$i]['TotalPrice'];
        }
        $sql = "INSERT INTO Orders (UserId,orderDate,totalAmount) VALUES (:UserId, :orderDate, :totalAmount)";
        $stmt = $this->pdoConnection->prepare($sql);

        
        $total_amount= $totalPrice;
        //getting current date
        $order_date = date("Y-m-d H:i:s");
    
        $stmt->bindParam(':UserId', $user_id);
        $stmt->bindParam(':orderDate', $order_date);
        $stmt->bindParam(':totalAmount', $total_amount);

        $stmt->execute();
        // return $stmt;

        $orderId =$this->pdoConnection->lastInsertId();
        for ($i = 0; $i < count($cartItem); $i++) {
            // echo $cartItem[$i]['TotalPrice'];
            $insertOrderItems = "INSERT INTO OrderItems (OrderId,DVDId,quantity,subTotal) VALUES (:OrderId,:DVDId,:quantity,:subTotal)";
            $insertOrderItems = $this->pdoConnection->prepare($insertOrderItems);
            // $insertOrderItems->bind_param('iiid',$orderId,$cartItem[$i]['DVDId'],$cartItem[$i]['Quantity'],$cartItem[$i]['TotalPrice']);
            $insertOrderItems->bindParam(':OrderId', $orderId);
            $insertOrderItems->bindParam(':DVDId', $cartItem[$i]['DVDId']);
            $insertOrderItems->bindParam(':quantity', $cartItem[$i]['Quantity']);
            $insertOrderItems->bindParam(':subTotal', $cartItem[$i]['TotalPrice']);
            $insertOrderItems->execute();
        }
    }  catch (PDOException $e) {
        echo("saveOrderDetailsIntoDatabase: " . $e->getMessage());
        return null;
    }
}
}