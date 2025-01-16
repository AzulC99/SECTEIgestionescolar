
<?php
class Core {
    protected $currentController = 'Pages'; // Cambiado de 'Login' a 'Pages'
    protected $currentMethod = 'index';
    protected $params = [];

    public function __construct() {
        $url = $this->getUrl();

        // Buscar en controladores
        if(isset($url[0])) {
            if(file_exists('../app/controllers/' . ucwords($url[0]). '.php')) {
                // Si existe, establecer como controlador
                $this->currentController = ucwords($url[0]);
                unset($url[0]);
            }
        }

        // Requerir el controlador
        require_once '../app/controllers/'. $this->currentController . '.php';
        $this->currentController = new $this->currentController;

        // Método
        if(isset($url[1])) {
            if(method_exists($this->currentController, $url[1])) {
                $this->currentMethod = $url[1];
                unset($url[1]);
            }
        }

        // Parámetros
        $this->params = $url ? array_values($url) : [];

        // Callback con array de params
        call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
    }

    public function getUrl() {
        if(isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            return $url;
        }
    }
}