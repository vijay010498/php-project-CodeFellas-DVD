<?php

class AuthManager
{
    public static function loginUser($userId, $email, $userType)
    {
        session_start();

        $userDetails = [
            "userId" => $userId,
            "email" => $email,
            "userType" => $userType
        ];

        // Store user details in the session
        $_SESSION["user"] = $userDetails;

        $expiry = time() + (30 * 24 * 60 * 60);
        setcookie('store_user', $userId, $expiry, '/', '', true, true);

        session_regenerate_id();
    }

    public static function logoutUser()
    {
        session_start();

        $_SESSION = [];

        session_destroy();

        setcookie('store_user', '', time() - 3600, '/', '', true, true);
    }

    public static function isLoggedIn()
    {
        session_start();
        return isset($_SESSION['user']);
    }

    public static function getCurrentUser()
    {
        session_start();
        return isset($_SESSION['user']) ? $_SESSION['user'] : null;
    }

    public static function isAdmin()
    {
        session_start();

        if (isset($_SESSION['user']) && $_SESSION['user']['userType'] === 1) {
            return true;
        }

        return false;
    }
}