<?php


require_once("Admin.php");
require_once("Auth.php");
require_once("AuthManager.php");
require_once("Cart.php");
require_once("Home.php");
require_once("Details.php");
require_once("Checkout.php");
require_once("UserOrders.php");
require_once("invoice_pdf.php");
$admin = new Admin();
$auth = new Auth();
$cart = new Cart();
$home = new Home();
$details = new Details();
$checkout = new Checkout();
$userOrder = new UserOrders();
$invoice = new Invoice();

// POST Apis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);
    $action = $data['action'];

    if ($action === "signUpNewUser") {
        $firstName = $data['firstName'];
        $lastName = $data['lastName'];
        $email = $data['email'];
        $password = $data['password'];
        $address = $data['address'];
        $phoneNumber = $data['phoneNumber'];

        $createdNewUser = $auth->signUpNewUser($firstName, $lastName, $email, $password, $address, $phoneNumber);

        if ($createdNewUser) {
            header('Content-Type: application/json');
            echo json_encode(['message' => 'Created']);
            http_response_code(200);
            exit();
        } else {
            http_response_code(500);
        }
    }



    if ($action === "signInUsr") {
        $email = $data['email'];
        $password = $data['password'];

        $signInUser = $auth->signInUsr($email, $password);

        if ($signInUser) {
            header('Content-Type: application/json');
            echo json_encode(['message' => 'Login Success']);
            http_response_code(200);
            exit();
        } else {
            http_response_code(500);
        }
    }

    if ($action === 'createGenre') {

        if (!AuthManager::isAdmin()) {
            header('Content-Type: application/json');
            echo json_encode(['message' => 'Need Admin Access, Please login as Admin']);
            http_response_code(401);
            exit();
        }
        $genreName = $data['genreName'];

        $created = $admin->createNewGenre($genreName);

        if ($created) {
            header('Content-Type: application/json');
            echo json_encode(['message' => 'Created']);
            http_response_code(200);
            exit();
        } else {
            http_response_code(500);
        }
    }

    if ($action === 'createDVD') {
        if (!AuthManager::isAdmin()) {
            header('Content-Type: application/json');
            echo json_encode(['message' => 'Need Admin Access, Please login as Admin']);
            http_response_code(401);
            exit();
        }
        $Title = $data['Title'];
        $GenreId = $data['GenreId'];
        $Price = $data['Price'];
        $stockQuantity = $data['stockQuantity'];
        $imageURL = $data['imageURL'];

        $created = $admin->createNewDVD($Title, $GenreId, $Price, $stockQuantity, $imageURL);
        if ($created) {
            header('Content-Type: application/json');
            echo json_encode(['message' => 'DVD Created']);
            http_response_code(200);
            exit();
        } else {
            http_response_code(500);
        }

    }


    if ($action === 'deleteDVD') {
        if (!AuthManager::isAdmin()) {
            header('Content-Type: application/json');
            echo json_encode(['message' => 'Need Admin Access, Please login as Admin']);
            http_response_code(401);
            exit();
        }
        $DVDId = $data['DVDId'];
        $deleted = $admin->deleteDvd($DVDId);
        if ($deleted) {
            header('Content-Type: application/json');
            echo json_encode(['message' => 'DVD Deleted']);
            http_response_code(200);
            exit();
        } else {
            http_response_code(500);
        }

    }


    if ($action === 'updateDVDQuantity') {
        if (!AuthManager::isAdmin()) {
            header('Content-Type: application/json');
            echo json_encode(['message' => 'Need Admin Access, Please login as Admin']);
            http_response_code(401);
            exit();
        }
        $DVDId = $data['DVDId'];
        $newQuantity = $data['newQuantity'];
        $updated = $admin->updateDVDQunty($DVDId, $newQuantity);
        if ($updated) {
            header('Content-Type: application/json');
            echo json_encode(['message' => 'DVD Updated']);
            http_response_code(200);
            exit();
        } else {
            http_response_code(500);
        }


    }


    if ($action === "addIntoCart") {
        if (!AuthManager::isLoggedIn()) {
            header('Content-Type: application/json');
            echo json_encode(['message' => 'Please Login First']);
            AuthManager::logoutUser();
            http_response_code(401);
            exit();
        }
        echo $data['DVDId'];
        $DVDId = $data['DVDId'];
        $quantity = $data['quantity'];
        $addedIntoCart = $cart->addDVDIntoCart($DVDId, $quantity);
        if ($addedIntoCart) {
            header('Content-Type: application/json');
            echo json_encode(['message' => 'Added DVD into Cart']);
            http_response_code(200);
            exit();
        } else {
            http_response_code(500);
        }
    }

    if ($action === "deleteFromCart") {
        if (!AuthManager::isLoggedIn()) {
            header('Content-Type: application/json');
            echo json_encode(['message' => 'Please Login First to delete cart']);
            AuthManager::logoutUser();
            http_response_code(401);
            exit();
        }
        $DVDId = $data['DVDId'];
        $deletedCart = $cart->deleteDVDFromCart($DVDId);
        if ($deletedCart) {
            header('Content-Type: application/json');
            echo json_encode(['message' => 'Deleted DVD from Cart']);
            http_response_code(200);
            exit();
        } else {
            http_response_code(500);
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    if ($_SERVER['REQUEST_URI'] === '/group-project-DVD-store/API.php/loginstatus') {
        $userLoggedIn = $auth->loginStatus();

        if ($userLoggedIn) {
            header('Content-Type: application/json');
            echo json_encode(['loginStatus' => true]);
            exit();
        } else {
            header('Content-Type: application/json');
            echo json_encode(['loginStatus' => false]);
            exit();
        }

    }

    if ($_SERVER['REQUEST_URI'] === '/group-project-DVD-store/API.php/logout') {
        $loggedOut = $auth->logout();

        if ($loggedOut) {
            header('Content-Type: application/json');
            echo json_encode(['message' => 'LoggedOut']);
            exit();
        } else {
            http_response_code(500);
        }
    }
    if ($_SERVER['REQUEST_URI'] === '/group-project-DVD-store/API.php/cart') {
        if (!AuthManager::isLoggedIn()) {
            header('Content-Type: application/json');
            echo json_encode(['message' => 'Please Login First']);
            AuthManager::logoutUser();
            http_response_code(401);
            exit();
        }
        $cartItems = $cart->getUsrCartItems();
        echo json_encode(['cartItems' => $cartItems]);

    }

    if ($_SERVER['REQUEST_URI'] === '/group-project-DVD-store/API.php/home') {
        $items = $home->fetchValues();
        echo json_encode(['items' => $items]);
    }

    if ($_SERVER['REQUEST_URI'] === '/group-project-DVD-store/API.php/dvds') {
        $items = $home->fetchValues();
        echo json_encode(['items' => $items]);
    }



    if ($_SERVER['REQUEST_URI'] === '/group-project-DVD-store/API.php/details') {
        if (!empty($_GET["DVDId"])) {
            $detail = $details->dvdDetails($_GET["DVDId"]);            
            echo json_encode(['detail' => $detail]);
        }
        else{
            header('Content-Type: application/json');
            echo json_encode(['message' => 'Please provide DVD id']);            
            http_response_code(401);
            exit();
        }      
        
    }

    if ($_SERVER['REQUEST_URI'] === '/group-project-DVD-store/API.php/checkoutAndPlaceOrder') {
        if (!AuthManager::isLoggedIn()) {
            header('Content-Type: application/json');
            echo json_encode(['message' => 'Please Login First']);
            AuthManager::logoutUser();
            http_response_code(401);
            exit();
        } else {
            $userId = AuthManager::getUserID();
            if($userId != null){
                $orderId = $userOrder->checkoutAndPlaceOrder($userId);
                $invoice->getpdfDetails($userId, $orderId);
            } else {
                header('Content-Type: application/json');
                echo json_encode(['message' => 'Please Login First']);
                exit();
            }
        }
    }



}