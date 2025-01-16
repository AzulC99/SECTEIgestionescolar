<?php
class LoginU extends Controller {
    public function __construct() {
        
    }

    public function loginusers() {
        $data = [
            'title' => 'Bienvenido',
            'description' => 'Sistema de Gestión Escolar'
        ];
        
        $this->view('pages/index', $data);
    }

    public function loginaspirantes() {
        $data = [
            'title' => 'Acerca de nosotros',
            'description' => 'Información sobre el sistema'
        ];
        
        $this->view('pages/about', $data);
    }
}
