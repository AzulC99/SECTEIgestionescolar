<?php
class Pages extends Controller {

    private $user;

    public function __construct() {
        //  $this->user = new User();
        
    }

    public function index() {
        $data = [
            'title' => 'Bienvenido',
            'description' => 'Sistema de Gestión Escolar'
        ];
        
        $this->view('pages/index', $data);
    }

    public function about() {
        $data = [
            'title' => 'Acerca de nosotros',
            'description' => 'Información sobre el sistema'
        ];
        
        $this->view('pages/about', $data);
    }

    public function aspirantes() {
        $data = [
            'title' => 'Aspirantes',
            'description' => 'Login aspirantes'
        ];
        
        $this->view('login/aspirantes', $data);
    }

    public function users() {
        $data = [
            'title' => 'Aspirantes',
            'description' => 'Login aspirantes'
        ];
        
        $this->view('login/users', $data);
    }

     public function registros() {
        $data = [
            'title' => 'Aspirantes',
            'description' => 'Login aspirantes'
        ];
        
        $this->view('login/registros', $data);
    }


        public function login() {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                // Process form
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                
                $data = [
                    'email' => trim($_POST['email']),
                    'password' => trim($_POST['password']),
                    'email_err' => '',
                    'password_err' => '',
                    'login_err' => ''
                ];
                
                // Validate email
                if (empty($data['email'])) {
                    $data['email_err'] = 'Por favor ingrese su email';
                }
                
                // Validate password
                if (empty($data['password'])) {
                    $data['password_err'] = 'Por favor ingrese su contraseña';
                }
                
                // Check for user/email
                if ($this->userModel->findUserByEmail($data['email'])) {
                    // User found
                } else {
                    $data['login_err'] = 'Usuario no encontrado';
                }
                
                // Make sure errors are empty
                if (empty($data['email_err']) && empty($data['password_err']) && empty($data['login_err'])) {
                    // Validated
                    // Check and set logged in user
                    $loggedInUser = $this->userModel->login($data['email'], $data['password']);
                    
                    if ($loggedInUser) {
                        // Create session
                        $this->createUserSession($loggedInUser);
                        // Redirect based on role
                        $this->redirectBasedOnRole($loggedInUser->role);
                    } else {
                        $data['login_err'] = 'Contraseña incorrecta';
                        $this->view('auth/login', $data);
                    }
                } else {
                    // Load view with errors
                    $this->view('auth/login', $data);
                }
            } else {
                // Init data
                $data = [
                    'email' => '',
                    'password' => '',
                    'email_err' => '',
                    'password_err' => '',
                    'login_err' => ''
                ];
                
                // Load view
                $this->view('auth/login', $data);
            }
        }
        
        private function createUserSession($user) {
            $_SESSION['user_id'] = $user->id;
            $_SESSION['user_email'] = $user->email;
            $_SESSION['user_name'] = $user->name;
            $_SESSION['user_role'] = $user->role;
        }
        
        private function redirectBasedOnRole($role) {
            switch ($role) {
                case 'admin':
                    redirect('admin/dashboard');
                    break;
                case 'manager':
                    redirect('manager/dashboard');
                    break;
                case 'supervisor':
                    redirect('supervisor/dashboard');
                    break;
                case 'employee':
                    redirect('employee/dashboard');
                    break;
                case 'client':
                    redirect('client/dashboard');
                    break;
                default:
                    redirect('pages/index');
                    break;
            }
        }
        
        public function logout() {
            unset($_SESSION['user_id']);
            unset($_SESSION['user_email']);
            unset($_SESSION['user_name']);
            unset($_SESSION['user_role']);
            session_destroy();
            redirect('auth/login');
        }
    
}

    
           
   

        