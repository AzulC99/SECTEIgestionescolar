<?php
// app/models/User.php
class User {
    private $db;
    private $table = 'users';

    public function __construct() {
        $this->db = new Database();
    }

    public function register($data) {
        // Hash password
        $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
        
        $this->db->query('INSERT INTO users (name, email, curp, password, role, status) 
                         VALUES (:name, :email, :curp, :password, :role, :status)');
        
        // Bind values
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':curp', $data['curp']);
        $this->db->bind(':password', $data['password']);
        $this->db->bind(':role', $data['role']);
        $this->db->bind(':status', 'active');

        return $this->db->execute();
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

    public function updateUserStatus($userId, $status) {
        $this->db->query('UPDATE users SET status = :status WHERE id = :id');
        $this->db->bind(':status', $status);
        $this->db->bind(':id', $userId);
        return $this->db->execute();
    }

    public function updatePassword($userId, $password) {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $this->db->query('UPDATE users SET password = :password WHERE id = :id');
        $this->db->bind(':password', $hashedPassword);
        $this->db->bind(':id', $userId);
        return $this->db->execute();
    }

    public function validatePassword($password) {
        // Mínimo 8 caracteres
        if (strlen($password) < 8) {
            return false;
        }

        // Al menos una mayúscula
        if (!preg_match('/[A-Z]/', $password)) {
            return false;
        }

        // Al menos un número
        if (!preg_match('/[0-9]/', $password)) {
            return false;
        }

        // Al menos un carácter especial
        if (!preg_match('/[!@#$%^&*]/', $password)) {
            return false;
        }

        return true;
    }

    public function validateCURP($curp) {
        return preg_match('/^[A-Z]{4}\d{6}[HM][A-Z]{5}\d{2}$/', $curp);
    }

    public function validateEmail($email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }
}

// app/controllers/AuthController.php
class AuthController {
    private $userModel;
    private $validationErrors;

    public function __construct() {
        $this->userModel = new User();
        $this->validationErrors = [];
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Process form
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            // Determine login type
            $loginType = isset($_POST['login_type']) ? $_POST['login_type'] : 'email';
            $user = null;

            if ($loginType === 'email') {
                // Validate email
                if (!$this->userModel->validateEmail($_POST['email'])) {
                    $this->validationErrors['email'] = 'Email inválido';
                } else {
                    $user = $this->userModel->findUserByEmail($_POST['email']);
                    if (!$user) {
                        $this->validationErrors['email'] = 'Usuario no encontrado';
                    }
                }
            } else {
                // Validate CURP
                if (!$this->userModel->validateCURP($_POST['curp'])) {
                    $this->validationErrors['curp'] = 'CURP inválido';
                } else {
                    $user = $this->userModel->findUserByCURP($_POST['curp']);
                    if (!$user) {
                        $this->validationErrors['curp'] = 'Usuario no encontrado';
                    }
                }
            }

            // Validate password
            if (empty($_POST['password'])) {
                $this->validationErrors['password'] = 'La contraseña es requerida';
            }

            // Check for errors
            if (empty($this->validationErrors)) {
                // Verify password
                if (password_verify($_POST['password'], $user->password)) {
                    if ($user->status !== 'active') {
                        $this->validationErrors['general'] = 'Usuario inactivo';
                    } else {
                        // Create session
                        $this->createUserSession($user);
                        $this->logLoginAttempt($user->id, true);
                        redirect('/dashboard');
                    }
                } else {
                    $this->validationErrors['password'] = 'Contraseña incorrecta';
                    $this->logLoginAttempt($user->id, false);
                }
            }

            // If we get here, something failed
            if (!empty($this->validationErrors)) {
                $data = [
                    'login_type' => $loginType,
                    'email' => $_POST['email'] ?? '',
                    'curp' => $_POST['curp'] ?? '',
                    'errors' => $this->validationErrors
                ];

                // Return JSON response for AJAX requests
                if ($this->isAjaxRequest()) {
                    header('Content-Type: application/json');
                    echo json_encode(['errors' => $this->validationErrors]);
                    exit;
                }

                // Regular form submission
                $this->view('auth/login', $data);
            }
        } else {
            // Init data
            $data = [
                'login_type' => 'email',
                'email' => '',
                'curp' => '',
                'errors' => []
            ];

            // Load view
            $this->view('auth/login', $data);
        }
    }

    public function changePassword() {
        if (!isLoggedIn()) {
            redirect('/auth/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'current_password' => trim($_POST['current_password']),
                'new_password' => trim($_POST['new_password']),
                'confirm_password' => trim($_POST['confirm_password']),
                'errors' => []
            ];

            // Validate current password
            $user = $this->userModel->findUserById($_SESSION['user_id']);
            if (!password_verify($data['current_password'], $user->password)) {
                $this->validationErrors['current_password'] = 'Contraseña actual incorrecta';
            }

            // Validate new password
            if (!$this->userModel->validatePassword($data['new_password'])) {
                $this->validationErrors['new_password'] = 'La nueva contraseña no cumple los requisitos';
            }

            // Validate password confirmation
            if ($data['new_password'] !== $data['confirm_password']) {
                $this->validationErrors['confirm_password'] = 'Las contraseñas no coinciden';
            }

            // If no errors, update password
            if (empty($this->validationErrors)) {
                if ($this->userModel->updatePassword($_SESSION['user_id'], $data['new_password'])) {
                    flash('password_success', 'Contraseña actualizada exitosamente');
                    redirect('/profile');
                } else {
                    $this->validationErrors['general'] = 'Error al actualizar la contraseña';
                }
            }

            // If AJAX request
            if ($this->isAjaxRequest()) {
                header('Content-Type: application/json');
                echo json_encode([
                    'success' => empty($this->validationErrors),
                    'errors' => $this->validationErrors
                ]);
                exit;
            }

            // Regular form submission
            $data['errors'] = $this->validationErrors;
            $this->view('auth/change_password', $data);
        } else {
            $data = [
                'current_password' => '',
                'new_password' => '',
                'confirm_password' => '',
                'errors' => []
            ];

            $this->view('auth/change_password', $data);
        }
    }

    private function createUserSession($user) {
        $_SESSION['user_id'] = $user->id;
        $_SESSION['user_email'] = $user->email;
        $_SESSION['user_name'] = $user->name;
        $_SESSION['user_role'] = $user->role;
    }

    private function logLoginAttempt($userId, $success) {
        $this->db->query('INSERT INTO login_attempts (user_id, success, ip_address, created_at) 
                         VALUES (:user_id, :success, :ip_address, NOW())');
        
        $this->db->bind(':user_id', $userId);
        $this->db->bind(':success', $success ? 1 : 0);
        $this->db->bind(':ip_address', $_SERVER['REMOTE_ADDR']);
        
        return $this->db->execute();
    }

    private function isAjaxRequest() {
        return !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && 
               strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
    }

    public function logout() {
        unset($_SESSION['user_id']);
        unset($_SESSION['user_email']);
        unset($_SESSION['user_name']);
        unset($_SESSION['user_role']);
        session_destroy();
        redirect('/auth/login');
    }
}

// SQL para la tabla de usuarios
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE,
    curp VARCHAR(18) UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'manager', 'supervisor', 'operator', 'analyst', 'guest') NOT NULL,
    status ENUM('active', 'inactive') NOT NULL DEFAULT 'active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

// SQL para la tabla de intentos de login
CREATE TABLE login_attempts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    success BOOLEAN NOT NULL,
    ip_address VARCHAR(45) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
);
