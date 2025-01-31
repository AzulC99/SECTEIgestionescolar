# Estructura de directorios
```
/proyecto
    /.htaccess
    /app
        /config
            config.php
            database.php
        /controllers
            Controller.php
            HomeController.php
        /helpers
            SessionHelper.php
            ValidationHelper.php
        /libraries
            Database.php
            Core.php
        /models
            User.php
        /views
            /layouts
                default.php
            /home
                index.php
    /public
        /.htaccess
        /css
        /js
        /img
        index.php
    package.json
    tailwind.config.js
```

# /proyecto/.htaccess
RewriteEngine On
RewriteRule ^$ public/ [L]
RewriteRule (.*) public/$1 [L]

# /proyecto/public/.htaccess
Options -Multiviews
RewriteEngine On
RewriteBase /proyecto/public
RewriteCond %{REQUEST_FILENAME} !-d
RewriteCond %{REQUEST_FILENAME} !-f
RewriteRule ^(.+)$ index.php?url=$1 [QSA,L]

# /proyecto/app/config/config.php
<?php
// Configuración de la base de datos
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'mvc_db');

// Configuración de la aplicación
define('APPROOT', dirname(dirname(__FILE__)));
define('URLROOT', 'http://localhost/proyecto');
define('SITENAME', 'MVC PHP Framework');

# /proyecto/app/config/database.php
<?php
class Database {
    private $host = DB_HOST;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $dbname = DB_NAME;
    
    private $dbh;
    private $stmt;
    private $error;
    
    public function __construct() {
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;
        $options = array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );
        
        try {
            $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
        } catch(PDOException $e) {
            $this->error = $e->getMessage();
            echo $this->error;
        }
    }
    
    public function query($sql) {
        $this->stmt = $this->dbh->prepare($sql);
    }
    
    public function bind($param, $value, $type = null) {
        if(is_null($type)) {
            switch(true) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }
        $this->stmt->bindValue($param, $value, $type);
    }
    
    public function execute() {
        return $this->stmt->execute();
    }
    
    public function resultSet() {
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }
    
    public function single() {
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_OBJ);
    }
    
    public function rowCount() {
        return $this->stmt->rowCount();
    }
}

# /proyecto/app/libraries/Core.php
<?php
class Core {
    protected $currentController = 'Home';
    protected $currentMethod = 'index';
    protected $params = [];
    
    public function __construct() {
        $url = $this->getUrl();
        
        if(isset($url[0])) {
            if(file_exists('../app/controllers/' . ucwords($url[0]) . 'Controller.php')) {
                $this->currentController = ucwords($url[0]);
                unset($url[0]);
            }
        }
        
        require_once '../app/controllers/' . $this->currentController . 'Controller.php';
        $this->currentController = $this->currentController . 'Controller';
        $this->currentController = new $this->currentController;
        
        if(isset($url[1])) {
            if(method_exists($this->currentController, $url[1])) {
                $this->currentMethod = $url[1];
                unset($url[1]);
            }
        }
        
        $this->params = $url ? array_values($url) : [];
        call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
    }
    
    public function getUrl() {
        if(isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            return $url;
        }
    }
}

# /proyecto/app/controllers/Controller.php
<?php
class Controller {
    public function model($model) {
        require_once '../app/models/' . $model . '.php';
        return new $model();
    }
    
    public function view($view, $data = []) {
        if(file_exists('../app/views/' . $view . '.php')) {
            require_once '../app/views/' . $view . '.php';
        } else {
            die('View does not exist');
        }
    }
}

# /proyecto/app/controllers/HomeController.php
<?php
class HomeController extends Controller {
    public function __construct() {
        $this->userModel = $this->model('User');
    }
    
    public function index() {
        $data = [
            'title' => 'Welcome'
        ];
        
        $this->view('home/index', $data);
    }
}

# /proyecto/app/models/User.php
<?php
class User {
    private $db;
    
    public function __construct() {
        $this->db = new Database;
    }
    
    public function getUsers() {
        $this->db->query("SELECT * FROM users");
        return $this->db->resultSet();
    }
}

# /proyecto/app/views/layouts/default.php
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo SITENAME; ?></title>
    <link href="/css/app.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <?php require_once APPROOT . '/views/' . $view . '.php'; ?>
    <script src="/js/app.js"></script>
</body>
</html>

# /proyecto/app/views/home/index.php
<div class="container mx-auto px-4">
    <h1 class="text-4xl font-bold text-gray-800 my-8"><?php echo $data['title']; ?></h1>
</div>

# /proyecto/public/index.php
<?php
require_once '../app/config/config.php';
require_once '../app/libraries/Core.php';
require_once '../app/libraries/Controller.php';
require_once '../app/libraries/Database.php';

$init = new Core();

# /proyecto/package.json
{
  "name": "mvc-php-project",
  "version": "1.0.0",
  "scripts": {
    "build": "tailwindcss -i ./src/css/input.css -o ./public/css/app.css --watch"
  },
  "devDependencies": {
    "tailwindcss": "^3.3.0"
  }
}

# /proyecto/tailwind.config.js
module.exports = {
  content: [
    "./app/views/**/*.php",
  ],
  theme: {
    extend: {},
  },
  plugins: [],
}


Configuración de Tailwind

Archivo de configuración
Script de compilación
Estructura de assets



Para comenzar a usar este framework:

Clona la estructura en tu servidor web
Configura la base de datos en /app/config/config.php
Instala las dependencias:

bashCopynpm install

Compila los estilos de Tailwind:

bashCopynpm run build
¿Necesitas que te explique alguna parte específica de la estructura?
    
   Para inicializar y usar el proyecto:

Instalar dependencias:

bashCopynpm install

Desarrollo:

bashCopynpm run dev

Producción:

bashCopynpm run build
Los cambios principales incluyen:

 
