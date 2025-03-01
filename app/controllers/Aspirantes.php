<?php
class Aspirantes extends Controller {
    
    public function __construct() {
        // Verificar si el usuario tiene rol de usuario
        if(!isAspirante()) {
            redirect('pages/login');
        }
    }
    
    public function index() {
        $data = [
            'title' => 'Mi Panel de Usuario'
        ];
        
        $this->view('aspirante/index', $data);
    }
    
    public function perfil() {
        $data = [
            'title' => 'Mi Perfil'
        ];
        
        $this->view('aspirante/perfil', $data);
    }