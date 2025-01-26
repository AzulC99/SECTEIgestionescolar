# Project Structure
public/
  ├── index.php
  ├── .htaccess
  └── assets/
      ├── css/
      └── img/
app/
  ├── config/
  │   └── config.php
  ├── controllers/
  │   ├── AuthController.php
  │   └── DashboardController.php
  ├── models/
  │   └── User.php
  ├── views/
  │   ├── auth/
  │   │   └── login.php
  │   └── dashboard/
  │       ├── index.php
  │       └── profile.php
  ├── helpers/
  │   └── SecurityHelper.php
  └── libraries/
      └── Database.php
.htaccess

# Root .htaccess
RewriteEngine On
RewriteRule ^$ public/ [L]
RewriteRule (.*) public/$1 [L]

# Public .htaccess
RewriteEngine On
RewriteCond %{REQUEST_FILENAME} !-d
RewriteCond %{REQUEST_FILENAME} !-f
RewriteRule ^(.+)$ index.php?url=$1 [QSA,L]

# Config/config.php
<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'login_system');
define('URLROOT', 'http://localhost/your-project');
define('APPROOT', dirname(dirname(__FILE__)));

# Models/User.php
<?php
class User {
    private $db;
    
    public function __construct() {
        $this->db = new Database();
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

# Helpers/SecurityHelper.php
<?php
class SecurityHelper {
    public static function encryptPassword($password) {
        return password_hash($password, PASSWORD_BCRYPT);
    }
    
    public static function verifyPassword($password, $hash) {
        return password_verify($password, $hash);
    }
}

# Views/auth/login.php
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <div class="min-h-screen flex">
        <!-- Image Section -->
        <div class="hidden lg:block relative w-1/2">
            <img class="absolute inset-0 h-full w-full object-cover" 
                 src="<?php echo URLROOT; ?>/assets/img/login-bg.jpg" 
                 alt="Background">
            <div class="absolute inset-0 bg-black opacity-50"></div>
            <div class="absolute inset-0 flex items-center justify-center">
                <img src="<?php echo URLROOT; ?>/assets/img/logo.png" 
                     alt="Logo" 
                     class="w-48">
            </div>
        </div>
        
        <!-- Form Section -->
        <div class="flex-1 flex flex-col justify-center py-12 px-4 sm:px-6 lg:px-20 xl:px-24">
            <div class="mx-auto w-full max-w-sm">
                <h2 class="mt-6 text-3xl font-extrabold text-gray-900">
                    Iniciar Sesión
                </h2>
                
                <form class="mt-8 space-y-6" action="<?php echo URLROOT; ?>/auth/login" method="POST">
                    <!-- Login Type Selector -->
                    <div class="flex space-x-4 mb-4">
                        <button type="button" 
                                class="flex-1 py-2 px-4 border rounded-md text-sm font-medium focus:outline-none focus:ring-2 focus:ring-blue-500 bg-blue-50" 
                                onclick="switchLoginType('email')">
                            Email
                        </button>
                        <button type="button" 
                                class="flex-1 py-2 px-4 border rounded-md text-sm font-medium focus:outline-none focus:ring-2 focus:ring-blue-500" 
                                onclick="switchLoginType('curp')">
                            CURP
                        </button>
                    </div>
                    
                    <!-- Email Input -->
                    <div id="emailInput" class="rounded-md shadow-sm -space-y-px">
                        <div>
                            <label for="email" class="sr-only">Email</label>
                            <input id="email" name="email" type="email" 
                                   class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm" 
                                   placeholder="Email">
                        </div>
                    </div>
                    
                    <!-- CURP Input -->
                    <div id="curpInput" class="rounded-md shadow-sm -space-y-px hidden">
                        <div>
                            <label for="curp" class="sr-only">CURP</label>
                            <input id="curp" name="curp" type="text" 
                                   class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm" 
                                   placeholder="CURP">
                        </div>
                    </div>
                    
                    <!-- Password Input -->
                    <div>
                        <label for="password" class="sr-only">Contraseña</label>
                        <input id="password" name="password" type="password" 
                               class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm" 
                               placeholder="Contraseña">
                    </div>
                    
                    <!-- Role Selection -->
                    <div>
                        <select name="role" 
                                class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                            <option value="admin">Administrador</option>
                            <option value="manager">Gerente</option>
                            <option value="supervisor">Supervisor</option>
                            <option value="operator">Operador</option>
                            <option value="analyst">Analista</option>
                            <option value="guest">Invitado</option>
                        </select>
                    </div>
                    
                    <div>
                        <button type="submit" 
                                class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Iniciar Sesión
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <script>
        function switchLoginType(type) {
            const emailInput = document.getElementById('emailInput');
            const curpInput = document.getElementById('curpInput');
            
            if (type === 'email') {
                emailInput.classList.remove('hidden');
                curpInput.classList.add('hidden');
            } else {
                emailInput.classList.add('hidden');
                curpInput.classList.remove('hidden');
            }
        }
    </script>
</body>
</html>

# Views/dashboard/index.php
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="w-64 bg-gray-800">
            <div class="flex items-center justify-center h-16 bg-gray-900">
                <img src="<?php echo URLROOT; ?>/assets/img/logo.png" alt="Logo" class="h-8">
            </div>
            <nav class="mt-5">
                <a href="<?php echo URLROOT; ?>/dashboard" 
                   class="flex items-center px-6 py-2 text-gray-100 hover:bg-gray-700">
                    <span>Dashboard</span>
                </a>
                <a href="<?php echo URLROOT; ?>/profile" 
                   class="flex items-center px-6 py-2 text-gray-100 hover:bg-gray-700">
                    <span>Perfil</span>
                </a>
                <a href="<?php echo URLROOT; ?>/auth/logout" 
                   class="flex items-center px-6 py-2 text-gray-100 hover:bg-gray-700">
                    <span>Cerrar Sesión</span>
                </a>
            </nav>
        </div>
        
        <!-- Main Content -->
        <div class="flex-1 overflow-auto">
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <h1 class="text-3xl font-bold text-gray-900">
                        Dashboard
                    </h1>
                </div>
            </header>
            
            <main class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
                <!-- Add your dashboard content here -->
            </main>
        </div>
    </div>
</body>
</html>
