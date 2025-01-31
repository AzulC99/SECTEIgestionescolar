<?php

class Role {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function getAllRoles() {
        $this->db->query('SELECT * FROM roles');
        return $this->db->resultSet();
    }

    public function getRolePermissions($role_id) {
        $this->db->query('SELECT p.* FROM permissions p 
                         JOIN role_permissions rp ON p.id = rp.permission_id 
                         WHERE rp.role_id = :role_id');
        $this->db->bind(':role_id', $role_id);
        return $this->db->resultSet();
    }
}