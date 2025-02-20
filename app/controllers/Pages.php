<?php
class Pages extends Controller {

    private $userModel;

    public function __construct() {
        $this->userModel = $this->model('UserModel');
         AuthHelper::requireLogin();
    }

    public function index() {
        $data = [
            'title' => 'Bienvenido',
            'description' => 'Sistema de Gestión Escolar'
        ];
        
        $this->view('pages/index', $data);
    }


    public function login() {
        
        
        $this->view('pages/login');
    }

     public function registro() {
        
        
        $this->view('pages/registro');
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            
            $data = [
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'email_err' => '',
                'password_err' => ''
            ];
            
            if (empty($data['email'])) {
                $data['email_err'] = 'Por favor ingrese su email';
            }
            
            if (empty($data['password'])) {
                $data['password_err'] = 'Por favor ingrese su contraseña';
            }
            
            if (empty($data['email_err']) && empty($data['password_err'])) {
                $user = $this->userModel->login($data['email'], $data['password']);
                
                if ($user) {
                    SessionHelper::set('user_id', $user->id);
                    SessionHelper::set('user_name', $user->name);
                    SessionHelper::set('user_email', $user->email);
                    SessionHelper::set('user_role', $user->role);

                    
                    $this->redirectBasedOnRole($user->role);
                } else {

                     $data['password_err'] = 'Email o contraseña incorrectos';
                    $this->view('pages/login', $data);
                }
            } else {
                $this->view('pages/login', $data);
            }
        } else {
            $data = [
                'email' => '',
                'password' => '',
                'email_err' => '',
                'password_err' => ''
            ];
            
            $this->view('pages/login', $data);
        }
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            
            $data = [
                'name' => trim($_POST['name']),
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'confirm_password' => trim($_POST['confirm_password']),
                'role' => 'user',
                'name_err' => '',
                'email_err' => '',
                'password_err' => '',
                'confirm_password_err' => ''
            ];
            
            if (empty($data['name'])) {
                $data['name_err'] = 'Por favor ingrese su nombre';
            }
            
            if (empty($data['email'])) {
                $data['email_err'] = 'Por favor ingrese su email';
            } elseif ($this->userModel->findUserByEmail($data['email'])) {
                $data['email_err'] = 'El email ya está en uso';
            }

             if (empty($data['password'])) {
                $data['password_err'] = 'Por favor ingrese una contraseña';
            } elseif (strlen($data['password']) < 6) {
                $data['password_err'] = 'La contraseña debe tener al menos 6 caracteres';
            }
            
            if (empty($data['confirm_password'])) {
                $data['confirm_password_err'] = 'Por favor confirme la contraseña';
            } elseif ($data['password'] != $data['confirm_password']) {
                $data['confirm_password_err'] = 'Las contraseñas no coinciden';
            }
            
            if (empty($data['name_err']) && empty($data['email_err']) && 
                empty($data['password_err']) && empty($data['confirm_password_err'])) {
                
                if ($this->userModel->register($data)) {
                    flash('register_success', 'Te has registrado correctamente, ahora puedes iniciar sesión');
                    header('Location: ' . URLROOT . '/pages/login');
                } else {
                    die('Algo salió mal');
                }
            } else {
                $this->view('pages/register', $data);
            }




        } else {
            $data = [
                'name' => '',
                'email' => '',
                'password' => '',
                'confirm_password' => '',
                'role' => 'user',
                'name_err' => '',
                'email_err' => '',
                'password_err' => '',
                'confirm_password_err' => ''
            ];
            
            $this->view('pages/registro', $data);
        }

         // Verificar que se subieron los tres documentos
            $requiredDocs = ['acta', 'curp', 'ine'];
            foreach ($requiredDocs as $doc) {
                if (!isset($_FILES[$doc]) || $_FILES[$doc]['error'] === UPLOAD_ERR_NO_FILE) {
                    throw new Exception('Todos los documentos son obligatorios');
                }
            }
            
            $uploadedFiles = [];
            
            // Procesar cada documento
            foreach ($requiredDocs as $doc) {
                $file = $_FILES[$doc];
                
                // Validar tipo de archivo
                if (!in_array($file['type'], ALLOWED_TYPES)) {
                    throw new Exception("Tipo de archivo no permitido para $doc");
                }
                
                // Validar tamaño
                if ($file['size'] > MAX_FILE_SIZE) {
                    throw new Exception("El archivo $doc excede el tamaño máximo permitido");
                }
                
                // Crear directorio si no existe
                $uploadDir = UPLOAD_PATH . $doc . '/';
                if (!file_exists($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }
                
                // Generar nombre único
                $fileName = uniqid() . '_' . basename($file['name']);
                $filePath = $uploadDir . $fileName;
                
                // Mover archivo
                if (!move_uploaded_file($file['tmp_name'], $filePath)) {
                    throw new Exception("Error al subir el archivo $doc");
                }
                
                $uploadedFiles[$doc] = [
                    'file_name' => $fileName,
                    'original_name' => $file['name']
                ];
            }
            
            // Guardar en base de datos
            if ($this->documentModel->saveDocuments($_SESSION['user_id'], $uploadedFiles)) {
                $response['success'] = true;
                $response['message'] = 'Documentos subidos correctamente';
            } else {
                throw new Exception('Error al guardar la información de los documentos');
            }
    }

    private function redirectBasedOnRole($role) {
        switch ($role) {
            case 'admin':
                redirect('admin/index');
                break;
            case 'coordinadora':
                redirect('coordinadora/index');
                break;
            case 'director':
                redirect('director/index');
                break;
            case 'directora':
                redirect('directora/index');
                break;
            case 'aspirante':
                redirect('aspirante/index');
                break;
            case 'apoyo':
                redirect('apoyo/index');
                break;
            default:
                redirect('pages/index');
                break;
        }
    }

     public function admin() {
        AuthHelper::requireRole('admin');
        $this->view('admin/index');
    }
    
    public function coordinadora() {
        AuthHelper::requireRole(['admin', 'coordinadora']);
        $this->view('coordinadora/index');
    }
    
    public function director() {
        AuthHelper::requireRole(['admin', 'coordinadora', 'director']);
        $this->view('director/index');
    }

    public function directora() {
        AuthHelper::requireRole(['admin', 'coordinadora', 'director', 'directora']);
        $this->view('directora/index');
    }

      public function apoyo() {
        AuthHelper::requireRole(['admin', 'coordinadora', 'director', 'directora', 'apoyo']);
        $this->view('apoyo/index');
    }


    
    public function aspirante() {
        $this->view('aspirante/index');
     }







    
    public function logout() {
        SessionHelper::destroy();
        header('Location: ' . URLROOT . '/users/login');
    }
}


    


    
           
   

        

    
           
   

        