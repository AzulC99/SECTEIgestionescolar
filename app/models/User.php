


<?php
class User {
    private $db;
    
    public function __construct() {
        $this->db = new Database;
    }
    
   
    
    public function loginWithEmail($email, $password) {
    // Properly parameterize the query - both email and password check
        $this->db->query('SELECT * FROM users WHERE email = :email');
        $this->db->bind(':email', $email);
        $row = $this->db->single();
    
    // If user found, compare the MD5 hash
        if ($row) {
            $stored_hash = $row->password;
            $input_hash = md5($password);
        
            if ($input_hash === $stored_hash) {
            return $row;
            }
        }
    
        return false;
    }

    // Login con CURP
    public function loginWithCURP($curp, $password) {
        $this->db->query('SELECT * FROM users WHERE curp = :curp');
        $this->db->bind(':curp', $curp);
        
        $row = $this->db->single();
        
         // If user found, compare the MD5 hash
        if ($row) {
            $stored_hash = $row->password;
            $input_hash = md5($password);
        
            if ($input_hash === $stored_hash) {
            return $row;
            }
        }
        
        return false;
    }
    
    // Registrar usuario
    public function register($data) {
        $this->db->query('INSERT INTO users (name, email, curp, password) VALUES (:name, :email, :curp, :password)');
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':curp', $data['curp']);
        $this->db->bind(':password', password_hash($data['password'], PASSWORD_DEFAULT));
        
        return $this->db->execute();
    }

    // Obtener usuarios por rol
    public function getUsersByRole($role) {
        $this->db->query('SELECT * FROM users WHERE role = :role');
        $this->db->bind(':role', $role);
        
        return $this->db->resultSet();
    }
    
    // Obtener usuario por ID
    public function getUserById($id) {
        $this->db->query('SELECT * FROM users WHERE id = :id');
        $this->db->bind(':id', $id);
        
        return $this->db->single();
    }
    
    // Actualizar rol de usuario
    public function updateUserRole($userId, $newRole) {
        $this->db->query('UPDATE users SET role = :role WHERE id = :id');
        $this->db->bind(':role', $newRole);
        $this->db->bind(':id', $userId);
        
        return $this->db->execute();
    }
}
?>
