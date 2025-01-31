<?php
class Pages extends Controller {
    public function __construct() {
        
    }

    public function index() {
        $data = [
            'title' => 'Bienvenido',
            'description' => 'Sistema de Gestión Escolar'
        ];
        
        $this->view('pages/index', $data);
    }

    public function about() {
        $data = [
            'title' => 'Acerca de nosotros',
            'description' => 'Información sobre el sistema'
        ];
        
        $this->view('pages/about', $data);
    }

    public function aspirantes() {
        $data = [
            'title' => 'Aspirantes',
            'description' => 'Login aspirantes'
        ];
        
        $this->view('login/aspirantes', $data);
    }

    public function registros() {
        $data = [
            'title' => 'Aspirantes',
            'description' => 'Login aspirantes'
        ];
        
        $this->view('login/registros', $data);
    }

    
}
