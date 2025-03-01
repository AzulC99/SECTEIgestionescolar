<?php
class Apoyo extends Controller {
    
    public function __construct() {
        // Verificar si el usuario tiene rol de usuario
        if(!isApoyo()) {
            redirect('pages/login');
        }
    }
    
    public function index() {
        $data = [
            'title' => 'Mi Panel de Usuario'
        ];
        
        $this->view('apoyo/index', $data);
    }
    
    public function perfil() {
        $data = [
            'title' => 'Mi Perfil'
        ];
        
        $this->view('apoyo/perfil', $data);
    }