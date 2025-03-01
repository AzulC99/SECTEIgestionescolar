
<?php
class Admin extends Controller {
    private $userModel;
    
    public function __construct() {
        // Verificar si el usuario tiene rol de admin
        if(!isAdmin()) {
            redirect('pages/login');
        }
        
        $this->userModel = $this->model('User');
    }
    
    public function index() {
        // Obtener datos para el dashboard del admin
        $users = $this->userModel->getUsersByRole('user');
        
        $data = [
            'title' => 'Panel de Administrador',
            'users' => $users
        ];
        
        $this->view('admin/index', $data);
    }
    
    public function users() {
        // Administrar usuarios
        $users = $this->userModel->getUsersByRole('user');
        
        $data = [
            'title' => 'Gestión de Usuarios',
            'users' => $users
        ];
        
        $this->view('admin/users', $data);
    }
    
    // public function changeUserRole($userId) {
    //     if($_SERVER['REQUEST_METHOD'] == 'POST') {
    //         // Procesar formulario para cambiar rol
    //         $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            
    //         $newRole = trim($_POST['role']);
            
    //         if($this->userModel->updateUserRole($userId, $newRole)) {
    //             flash('user_message', 'Rol actualizado correctamente');
    //             redirect('admin/users');
    //         } else {
    //             die('Algo salió mal');
    //         }
    //     } else {
    //         // Obtener usuario
    //         $user = $this->userModel->getUserById($userId);
            
    //         $data = [
    //             'title' => 'Cambiar Rol',
    //             'user' => $user
    //         ];
            
    //         $this->view('admin/users/change_role', $data);
    //     }
    }
}
?>