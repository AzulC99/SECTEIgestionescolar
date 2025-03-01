<?php
class Coordinador extends Controller {
    
    public function __construct() {
        // Verificar si el usuario tiene rol de usuario
        if(!isCoordinador()) {
            redirect('pages/login');
        }
    }
    
    public function index() {
        $data = [
            'title' => 'Mi Panel de Usuario'
        ];
        
        $this->view('coordinador/index', $data);
    }
    
    public function perfil() {
        $data = [
            'title' => 'Mi Perfil'
        ];
        
        $this->view('coordinador/perfil', $data);
    }