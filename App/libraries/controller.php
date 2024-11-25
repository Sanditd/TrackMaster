<?php
    class controller{
        //To Load the Model
        public function model($model){
            require_once $path=__DIR__ .'/../model/'. $model. '.php';
            //Instantiate the model and pass it to the controller member variable
            return new $model();
        }

    //To Load the View
    public function view($view, $data = []) {
        $path = __DIR__ . '/../views/' . $view . '.php';
        if (file_exists($path)) {
            extract($data);
            require_once $path;
        } else {
            die("Corresponding View does not exist: $path");
        }
    }
    
    }

?>