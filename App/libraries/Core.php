<?php

    class Core{
        //Url format /controller/method/params
        protected $currentController = 'Pages';
        protected $currentMethod = 'index';
        protected $params = [];

        public function __construct(){
           // print_r($this->getUrl());

           $url=$this->getUrl();

           if(!empty($url) && file_exists('../app/controllers/'.ucwords($url[0]).'.php')){

                //if the controller exits, then laod it
                $this->currentController = ucwords($url[0]);
                unset($url[0]);

                //unset the controller form url
                require_once '../App/Controllers/'.$this->currentController.'.php';

                //init the controller
                $this->currentController= new $this->currentController;

                //check method in the url
                if(isset($url[1])){
                    if(method_exists($this->currentController,$url[1])){
                        $this->currentMethod=$url[1];
                        unset($url[1]);
                    }
                }

                //get params
                $this->params=$url ? array_values($url) :[];

                //echo "Controller: " . get_class($this->currentController) . "<br>";
               // echo "Method: " . $this->currentMethod . "<br>";
               // echo "Params: ";
               // print_r($this->params);
                //echo "<br>";

                //call method and pass params
                call_user_func_array([$this->currentController, $this->currentMethod], $this->params);

           }elseif(empty($url[0])){
            echo "controller not exist";
           }else{
            echo "controller file does not exist";
           }
        }

        public function getUrl(){
            if(isset($_GET['url'])){
                $url=rtrim($_GET['url'],'/');
                $url=filter_var($url,FILTER_SANITIZE_URL);
                $url=explode('/',$url);
                return $url;
            }
        }
    }

?>