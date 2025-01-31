<?php
class DirectoraController extends Controller {
    public function __construct() {
        if (!Auth::isAuthorized('directora')) {
            redirect('auth/login');
        }
    }
    
    public function dashboard() {
        $data = [
            'title' => 'directora Dashboard',
            'users' => $this->userModel->getAllUsers(),
            'stats' => $this->statsModel->getAdminStats()
        ];
        $this->view('directora/dashboard', $data);
    }
    
    // public function manageUsers() {
    //     // Lógica para gestionar usuarios
    //     $this->view('admin/users/manage');
    // }
    
    // public function systemSettings() {
    //     $this->view('admin/settings');
    // }
}