<?php
class Pages extends Controller {

     private $userModel;
     
    public function __construct() {
         $this->userModel = $this->model('User');
        
    }

     public function index() {
         
        
         $this->view('pages/index');
     }

    	// Initial view 
		

    

     public function registro() {
        
        
        $this->view('pages/registro');
    }

     public function resultados() {
        
        
        $this->view('pages/resultados');
    }

     public function convocatorias() {
        
        
        $this->view('pages/convocatorias');
    }

    

     public function login() {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Procesar formulario
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            
            $data = [
                'login_id' => trim($_POST['login_id']),
                'password' => trim($_POST['password']),
                'login_type' => trim($_POST['login_type']),
                'login_id_err' => '',
                'password_err' => ''
            ];
            
            // Validaciones similares al código anterior
            // ...
            
            // Verificar usuario
            $user = null;
            if($data['login_type'] == 'email') {
                if(!empty($data['login_id']) && !empty($data['password'])) {
                    $user = $this->userModel->loginWithEmail($data['login_id'], $data['password']);
                }
            } else {
                if(!empty($data['login_id']) && !empty($data['password'])) {
                    $user = $this->userModel->loginWithCURP($data['login_id'], $data['password']);
                }
            }
            
            if($user) {
                // Crear sesión
                $this->createUserSession($user);
                
                // Redirigir según el rol
                switch($user->role) {
                    case 'admin':
                        redirect('admin/index');
                        break;
                    case 'aspirante':
                        redirect('aspirante/index');
                        break;
                    case 'director':
                        redirect('director/index');
                        break;
                    case 'directora':
                        redirect('directora/index');
                        break;
                    case 'subdirectora':
                        redirect('subdirectora/index');
                        break;
                    case 'coordinador':
                        redirect('coordinador/index');
                        break;
                    case 'apoyo':
                        redirect('apoyo/index');
                        break;
                    default:
                        redirect('guest/index');
                        break;
                }
            } else {
                // Usuario o contraseña incorrectos
                if(!empty($data['login_id']) && !empty($data['password'])) {
                    $data['password_err'] = 'Credenciales incorrectas';
                }
                $this->view('pages/login', $data);
            }
        } else {
            // Inicializar formulario
            $data = [
                'login_id' => '',
                'password' => '',
                'login_type' => 'email',
                'login_id_err' => '',
                'password_err' => ''
            ];
            
            // Cargar vista
            $this->view('pages/login', $data);
        }
    }
    
    // Crear sesión de usuario con información de rol
    public function createUserSession($user) {
        $_SESSION['user_id'] = $user->id;
        $_SESSION['user_email'] = $user->email;
        $_SESSION['user_name'] = $user->name;
        $_SESSION['user_role'] = $user->role;
    }
    
    // Cerrar sesión
    public function logout() {
        unset($_SESSION['user_id']);
        unset($_SESSION['user_email']);
        unset($_SESSION['user_name']);
        unset($_SESSION['user_role']);
        session_destroy();
        redirect('pages/login');
    }
}

    
    
   
    // Restablecimiento de contraseña - Formulario

     

    


    
           
   

        