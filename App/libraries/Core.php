<?php
class Core {
    protected $currentController = 'Student';
    protected $currentMethod = 'index';
    protected $params = [];

    public function __construct() {
        $url = $this->getUrl();

<<<<<<< HEAD:App/libraries/core.php
        if ($url && file_exists('../app/controllers/' . ucwords($url[0]) . '.php')) {
            $this->currentController = ucwords($url[0]);
            unset($url[0]);
=======
        public function __construct(){
            $url = $this->getUrl();

            if(file_exists('../App/controllers/'.ucwords($url[0]).'.php')){
                //if the controller exists then load it
                $this->currentController = ucwords($url[0]);
                //unset the controller in the URL
                unset($url[0]);
                //call the controller
                require_once '../app/controllers/'.$this->currentController.'.php';
                //Instantiate the controller
                $this->currentController = new $this->currentController;

                //check whether the method exists in the controller
                if(isset($url[1])){
                    if(method_exists($this->currentController, $url[1])){
                        //if the method exists then load it
                        $this->currentMethod = $url[1];
                        //unset the method in the URL
                        unset($url[1]);
                    }
                }

                //get parameter list
                $this->params = $url? array_values($url) : [];
                //call the method and pass parameters list
                call_user_func_array([$this->currentController,$this->currentMethod],$this->params);
            }
>>>>>>> a18bb63d2148c1885e866e74413e8a8b905e864a:App/libraries/Core.php
        }

        require_once '../app/controllers/' . $this->currentController . '.php';
        $this->currentController = new $this->currentController;

        if (isset($url[1]) && method_exists($this->currentController, $url[1])) {
            $this->currentMethod = $url[1];
            unset($url[1]);
        }

        $this->params = $url ? array_values($url) : [];
        call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
    }

    public function getUrl() {
        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            return explode('/', $url);
        }
    }
}
?>
