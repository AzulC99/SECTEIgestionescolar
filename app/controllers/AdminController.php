<?php
class AdminController extends Controller {
    public function __construct() {
        if (!Auth::isAuthorized('admin')) {
            redirect('auth/login');
        }
    }
    
    public function dashboard() {
        $data = [
            'title' => 'Admin Dashboard',
            'users' => $this->userModel->getAllUsers(),
            'stats' => $this->statsModel->getAdminStats()
        ];
        $this->view('admin/dashboard', $data);
    }
    
    public function manageUsers() {
        // Lógica para gestionar usuarios
        $this->view('admin/users/manage');
    }
    
    public function systemSettings() {
        $this->view('admin/settings');
    }
}