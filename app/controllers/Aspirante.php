<?php
class AspiranteController extends Controller {
    public function __construct() {
        if (!Auth::isAuthorized('aspirante')) {
            redirect('auth/login');
        }
    }
    
    public function dashboard() {
        $data = [
            'title' => 'apoyo Dashboard',
            'users' => $this->userModel->getAllUsers(),
            'stats' => $this->statsModel->getAdminStats()
        ];
        $this->view('aspirante/dashboard', $data);
    }
    
    // public function manageUsers() {
    //     // Lógica para gestionar usuarios
    //     $this->view('admin/users/manage');
    // }
    
    // public function systemSettings() {
    //     $this->view('admin/settings');
    // }
}