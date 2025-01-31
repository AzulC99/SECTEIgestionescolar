<?php
class Auth {
    public static function isAuthorized($role) {
        if (!isset($_SESSION['user_role'])) {
            return false;
        }
        
        $roleHierarchy = [
            'admin' => ['admin', 'manager', 'supervisor', 'employee', 'client'],
            'manager' => ['manager', 'supervisor', 'employee', 'client'],
            'supervisor' => ['supervisor', 'employee', 'client'],
            'employee' => ['employee', 'client'],
            'client' => ['client']
        ];
        
        return in_array($role, $roleHierarchy[$_SESSION['user_role']]);
    }
}