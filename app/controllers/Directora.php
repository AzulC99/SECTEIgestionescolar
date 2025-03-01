<?php
class Directora extends Controller {
    
    
    public function __construct() {
        // Verificar si el usuario tiene rol de admin
        if(!isDirectora()) {
            redirect('pages/login');
        }
        
       
    }
    
    public function index() {
        
        
        $data = [
            'title' => 'Panel de Administrador',
            
        ];
        
        $this->view('directora/index', $data);
    }
    
    // public function users() {
    //     // Administrar usuarios
    //     $users = $this->userModel->getUsersByRole('user');
        
    //     $data = [
    //         'title' => 'Gestión de Usuarios',
    //         'users' => $users
    //     ];
        
    //     $this->view('director/users', $data);
    // }
    
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