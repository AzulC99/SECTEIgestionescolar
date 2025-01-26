// config/Database.php
<?php
class Database {
    private $host = "localhost";
    private $db_name = "user_roles_db";
    private $username = "root";
    private $password = "";
    private $conn = null;

    public function getConnection() {
        try {
            $this->conn = new PDO(
                "mysql:host=" . $this->host . ";dbname=" . $this->db_name,
                $this->username,
                $this->password
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            echo "Connection error: " . $e->getMessage();
        }
        return $this->conn;
    }
}

// models/User.php
<?php
class User {
    private $conn;
    private $table = "users";

    public $id;
    public $username;
    public $password;
    public $role_id;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function login($username, $password) {
        $query = "SELECT id, username, role_id, password FROM " . $this->table . 
                 " WHERE username = :username";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":username", $username);
        $stmt->execute();

        if($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            if(password_verify($password, $row['password'])) {
                return $row;
            }
        }
        return false;
    }
}

// models/Role.php
<?php
class Role {
    const ADMIN = 1;
    const MANAGER = 2;
    const SUPERVISOR = 3;
    const EMPLOYEE = 4;
    const CLIENT = 5;
    const GUEST = 6;

    private static $permissions = [
        self::ADMIN => ['*'],
        self::MANAGER => ['dashboard', 'reports', 'users', 'products'],
        self::SUPERVISOR => ['dashboard', 'reports', 'products'],
        self::EMPLOYEE => ['dashboard', 'products'],
        self::CLIENT => ['products', 'profile'],
        self::GUEST => ['login', 'register']
    ];

    public static function hasPermission($roleId, $action) {
        if(!isset(self::$permissions[$roleId])) {
            return false;
        }
        
        if(in_array('*', self::$permissions[$roleId])) {
            return true;
        }

        return in_array($action, self::$permissions[$roleId]);
    }
}

// controllers/AuthController.php
<?php
class AuthController {
    private $user;
    
    public function __construct() {
        $database = new Database();
        $db = $database->getConnection();
        $this->user = new User($db);
    }

    public function login() {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';

            if($user = $this->user->login($username, $password)) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['role_id'] = $user['role_id'];
                $this->redirect('dashboard');
            } else {
                $_SESSION['error'] = "Invalid credentials";
                $this->redirect('login');
            }
        }
        require_once 'views/auth/login.php';
    }

    private function redirect($page) {
        header("Location: /$page");
        exit;
    }
}

// middleware/AuthMiddleware.php
<?php
class AuthMiddleware {
    public static function authenticate() {
        if(!isset($_SESSION['user_id'])) {
            header("Location: /login");
            exit;
        }
    }

    public static function authorize($action) {
        self::authenticate();
        
        if(!Role::hasPermission($_SESSION['role_id'], $action)) {
            header("Location: /unauthorized");
            exit;
        }
    }
}

// .htaccess
RewriteEngine On
RewriteBase /

# Si el archivo o directorio no existe, redirige a index.php
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^(.*)$ index.php?url=$1 [QSA,L]

# index.php
<?php
session_start();

require_once 'config/Database.php';
require_once 'models/User.php';
require_once 'models/Role.php';
require_once 'controllers/AuthController.php';
require_once 'middleware/AuthMiddleware.php';

$url = $_GET['url'] ?? 'home';
$url = rtrim($url, '/');
$url = filter_var($url, FILTER_SANITIZE_URL);
$url = explode('/', $url);

$controller = isset($url[0]) ? $url[0] : 'home';
$action = isset($url[1]) ? $url[1] : 'index';

switch($controller) {
    case 'login':
        $auth = new AuthController();
        $auth->login();
        break;
    case 'dashboard':
        AuthMiddleware::authorize('dashboard');
        // Dashboard controller logic
        break;
    case 'products':
        AuthMiddleware::authorize('products');
        // Products controller logic
        break;
    // Add other controllers as needed
    default:
        // 404 page or redirect
        break;
}
