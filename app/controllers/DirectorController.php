<?php
class DirectorController extends Controller {
    public function __construct() {
        if (!Auth::isAuthorized('director')) {
            redirect('auth/login');
        }
    }
    
    public function dashboard() {
        $data = [
            'title' => 'Director Dashboard',
            'users' => $this->userModel->getAllUsers(),
            'stats' => $this->statsModel->getAdminStats()
        ];
        $this->view('director/dashboard', $data);
    }
    
    // public function manageUsers() {
    //     // Lógica para gestionar usuarios
    //     $this->view('admin/users/manage');
    // }
    
    // public function systemSettings() {
    //     $this->view('admin/settings');
    // }
}