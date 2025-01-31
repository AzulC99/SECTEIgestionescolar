
<?php
class User {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function register($data) {
        $this->db->query('INSERT INTO users (name, email, curp, password, role_id, is_active) 
                         VALUES (:name, :email, :curp, :password, :role_id, :is_active)');
        
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':curp', $data['curp']);
        $this->db->bind(':password', password_hash($data['password'], PASSWORD_DEFAULT));
        $this->db->bind(':role_id', $data['role_id']);
        $this->db->bind(':is_active', 1);

        return $this->db->execute();
    }

    public function login($email, $password) {
        $this->db->query('SELECT * FROM users WHERE email = :email AND is_active = 1');
        $this->db->bind(':email', $email);
        
        $row = $this->db->single();
        if($row && password_verify($password, $row->password)) {
            return $row;
        }
        return false;
    }

    public function findUserByEmail($email) {
        $this->db->query('SELECT * FROM users WHERE email = :email');
        $this->db->bind(':email', $email);
        return $this->db->single();
    }

    public function findUserByCURP($curp) {
        $this->db->query('SELECT * FROM users WHERE curp = :curp');
        $this->db->bind(':curp', $curp);
        return $this->db->single();
    }
}






   