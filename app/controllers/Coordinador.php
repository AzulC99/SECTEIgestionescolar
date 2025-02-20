<?php
class CoordinadorController extends Controller {
    public function __construct() {
        if (!Auth::isAuthorized('coordinador')) {
            redirect('auth/login');
        }
    }
    
    public function dashboard() {
        $data = [
            'title' => 'coordinador Dashboard',
            'users' => $this->userModel->getAllUsers(),
            'stats' => $this->statsModel->getAdminStats()
        ];
        $this->view('coordinador/dashboard', $data);
    }
    
    // public function manageUsers() {
    //     // Lógica para gestionar usuarios
    //     $this->view('admin/users/manage');
    // }
    
    // public function systemSettings() {
    //     $this->view('admin/settings');
    // }
}