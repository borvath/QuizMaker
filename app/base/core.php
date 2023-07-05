<?php
class Core {
    protected mixed $currentController = 'controllers/Users';
    protected string $currentMethod = 'Login';
    protected array $params = [];

    public function __construct() {
        $url = $this->GetUrl();
        if(file_exists('../controllers/'.ucwords($url[0]).'.php')) {
            $this->currentController = ucwords($url[0]);
            unset($url[0]);
        }
        require_once '../'.$this->currentController.'.php';

        $this->currentController = new $this->currentController;

        if (isset($url[1])) {
            if (method_exists($this->currentController, $url[1])) {
                $this->currentMethod = $url[1];
                unset($url[1]);
            }
        }
        $this->params = $url ? array_values($url) : [];
        call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
    }
    public function GetUrl() : array {
        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            return explode('/', $url);
        }
        return [];
    }
}