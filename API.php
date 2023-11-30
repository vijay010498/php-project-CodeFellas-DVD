<?php


require_once("Admin.php");
require_once("Auth.php");
$admin = new Admin();
$auth = new Auth();


// POST Apis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if ($_POST['action'] === "signUpNewUser") {
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $address = $_POST['address'];
        $phoneNumber = $_POST['phoneNumber'];

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

    if ($_POST['action'] === "signInUsr") {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $signInUser = $auth->signInUsr($email,$password);

        if ($signInUser) {
            header('Content-Type: application/json');
            echo json_encode(['message' => 'Created']);
            http_response_code(200);
            exit();
        } else {
            http_response_code(500);
        }
    }

    if ($_POST['action'] === 'createGenre') {

        if (!AuthManager::isAdmin()) {
            header('Content-Type: application/json');
            echo json_encode(['message' => 'Need Admin Access, Please login as Admin']);
            http_response_code(401);
            exit();
        }
        $genreName = $_POST['genreName'];

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

    if ($_POST['action'] === 'createDVD') {
        if (!AuthManager::isAdmin()) {
            header('Content-Type: application/json');
            echo json_encode(['message' => 'Need Admin Access, Please login as Admin']);
            http_response_code(401);
            exit();
        }
        $Title = $_POST['Title'];
        $GenreId = $_POST['GenreId'];
        $Price = $_POST['Price'];
        $stockQuantity = $_POST['stockQuantity'];
        $imageURL = $_POST['imageURL'];

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


    if ($_POST['action'] === 'deleteDVD') {
        if (!AuthManager::isAdmin()) {
            header('Content-Type: application/json');
            echo json_encode(['message' => 'Need Admin Access, Please login as Admin']);
            http_response_code(401);
            exit();
        }
        $DVDId = $_POST['DVDId'];
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


    if ($_POST['action'] === 'updateDVDQuantity') {
        if (!AuthManager::isAdmin()) {
            header('Content-Type: application/json');
            echo json_encode(['message' => 'Need Admin Access, Please login as Admin']);
            http_response_code(401);
            exit();
        }
        $DVDId = $_POST['DVDId'];
        $newQuantity = $_POST['newQuantity'];
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
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
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
}