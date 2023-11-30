<?php

require_once("Queries.php");
require_once("AuthManager.php");

class Auth extends Queries
{

    public function __construct()
    {
        parent::__construct();
    }

    public function signUpNewUser($firstName, $lastName, $email, $password, $address, $phoneNumber) {
        return $this->signUpUser($firstName, $lastName, $email, $password, $address, $phoneNumber);
    }

    public function signInUsr($email, $password) {
        return $this->signInUser($email, $password);
    }

    public function logout() {
        return AuthManager::logoutUser();
    }

}