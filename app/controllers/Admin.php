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

    
        public function dashboard() {
            $this->view('admin/dashboard');
        }
    
        public function manageUsers() {
            $userModel = $this->model('User');
            $users = $userModel->getAllUsers();
            $this->view('admin/manage_users', ['users' => $users]);
        }
    
        public function updateUserStatus() {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $data = [
                    'user_id' => $_POST['user_id'],
                    'status' => $_POST['status']
                ];
    
                $errors = $this->validateInput($data, [
                    'user_id' => 'required',
                    'status' => 'required'
                ]);
    
                if (empty($errors)) {
                    $userModel = $this->model('User');
                    if ($userModel->updateStatus($data['user_id'], $data['status'])) {
                        flash('success', 'User status updated successfully');
                    } else {
                        flash('error', 'Failed to update user status');
                    }
                } else {
                    flash('error', 'Invalid input');
                }
            }
            redirect('admin/manageUsers');
        }
    }




}