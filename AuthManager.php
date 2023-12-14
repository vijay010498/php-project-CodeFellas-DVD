<?php


class AuthManager
{
    public function loginUser($userId, $email, $userType)
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $userDetails = [
            "userId" => $userId,
            "email" => $email,
            "userType" => $userType
        ];

        $_SESSION["user"] = $userDetails;

        $expiry = time() + (30 * 24 * 60 * 60);
        setcookie('store_user', $userId, $expiry, '/', '', true, true);

        session_regenerate_id();
    }

    public static function logoutUser()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $_SESSION = [];

        session_destroy();

        setcookie('store_user', '', time() - 3600, '/', '', true, true);
        return true;
    }

    public static function isLoggedIn()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        return isset($_SESSION['user']);
    }

    public function getCurrentUser()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        return isset($_SESSION['user']) ? $_SESSION['user'] : null;
    }

    public static function isAdmin()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (isset($_SESSION['user']) && $_SESSION['user']['userType'] === 1) {
            return true;
        }

        return false;
    }

    public static function getUserID()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (isset($_SESSION['user'])) {
            return $_SESSION['user']['userId'];
        } elseif (isset($_COOKIE['store_user'])) {
            return $_COOKIE['store_user'];
        }

        return null;
    }

}