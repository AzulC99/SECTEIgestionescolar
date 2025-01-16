<?php
class Users extends Controller {
    private $userModel;

    public function __construct() {
        $this->userModel = $this->model('User');
    }

    public function register() {
        // Check for POST
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Process form
            
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            // Init data
            $data = [
                'nombre' => trim($_POST['nombre']),
                'apellido' => trim($_POST['apellido']),
                'email' => trim($_POST['email']),
                'username' => trim($_POST['username']),
                'password' => trim($_POST['password']),
                'confirm_password' => trim($_POST['confirm_password']),
                'rol' => 'usuario', // Por defecto
                'nombre_err' => '',
                'apellido_err' => '',
                'email_err' => '',
                'username_err' => '',
                'password_err' => '',
                'confirm_password_err' => ''
            ];

            // Validate Email
            if(empty($data['email'])) {
                $data['email_err'] = 'Por favor ingrese el email';
            } else {
                // Check email
                if($this->userModel->findUserByEmail($data['email'])) {
                    $data['email_err'] = 'Email ya está registrado';
                }
            }

            // Validate Username
            if(empty($data['username'])) {
                $data['username_err'] = 'Por favor ingrese el usuario';
            } else {
                // Check username
                if($this->userModel->findUserByUsername($data['username'])) {
                    $data['username_err'] = 'Usuario ya existe';
                }
            }

            // Validate Name
            if(empty($data['nombre'])) {
                $data['nombre_err'] = 'Por favor ingrese el nombre';
            }

            // Validate Password
            if(empty($data['password'])) {
                $data['password_err'] = 'Por favor ingrese la contraseña';
            } elseif(strlen($data['password']) < 6) {
                $data['password_err'] = 'La contraseña debe tener al menos 6 caracteres';
            }

            // Validate Confirm Password
            if(empty($data['confirm_password'])) {
                $data['confirm_password_err'] = 'Por favor confirme la contraseña';
            } else {
                if($data['password'] != $data['confirm_password']) {
                    $data['confirm_password_err'] = 'Las contraseñas no coinciden';
                }
            }

            // Make sure errors are empty
            if(empty($data['email_err']) && empty($data['username_err']) && empty($data['nombre_err']) && 
               empty($data['password_err']) && empty($data['confirm_password_err'])) {
                // Validated
                
                // Register User
                if($this->userModel->register($data)) {
                    flash('register_success', 'Ya estás registrado y puedes iniciar sesión');
                    redirect('users/login');
                } else {
                    die('Algo salió mal');
                }
            } else {
                // Load view with errors
                $this->view('users/register', $data);
            }

        } else {
            // Init data
            $data = [
                'nombre' => '',
                'apellido' => '',
                'email' => '',
                'username' => '',
                'password' => '',
                'confirm_password' => '',
                'rol' => '',
                'nombre_err' => '',
                'apellido_err' => '',
                'email_err' => '',
                'username_err' => '',
                'password_err' => '',
                'confirm_password_err' => ''
            ];

            // Load view
            $this->view('users/register', $data);
        }
    }