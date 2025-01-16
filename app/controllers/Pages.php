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
}

    
           
   

        