<?php
class Auth {
    public static function Login($user) : bool {
        session_regenerate_id();
        $_SESSION['user_id'] = $user->user_id;
        $_SESSION['last_login'] = time();

        return true;
    }
    public static function Logout() : bool {
        unset($_SESSION['user_id']);
        unset($_SESSION['last_login']);
        session_destroy();

        return true;
    }
    public static function IsLoggedIn() : bool {
        return isset($_SESSION['user_id']);
    }
    public static function RequireLogin() : void {
        if (!self::isLoggedIn()) {
            header('Location: ../users/login.php');
            exit;
        }
    }
}