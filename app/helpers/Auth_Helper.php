<?php
class Auth_Helper {
    public static function isLoggedIn() {
        return isset($_SESSION['user_id']);
    }

    public static function hasPermission($permission) {
        if (!isset($_SESSION['permissions'])) return false;
        return in_array($permission, $_SESSION['permissions']);
    }

    public static function requirePermission($permission) {
        if (!self::hasPermission($permission)) {
            header('Location: ' . BASEURL . '/error/unauthorized');
            exit;
        }
    }

    public static function hashPassword($password) {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    public static function verifyPassword($password, $hash) {
        return password_verify($password, $hash);
    }
}