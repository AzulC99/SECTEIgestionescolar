<?php
class LoginU extends Controller {
    public function __construct() {
        
    }

    public function users() {
        $data = [
            'title' => 'Usuarios',
            'description' => 'Login usuarios'
        ];
        
        $this->view('login/users', $data);
    }

    public function aspirantes() {
        $data = [
            'title' => 'Aspirantes',
            'description' => 'Login aspirantes'
        ];
        
        $this->view('login/aspirantes', $data);
    }

    
    


}
