<?php
    class controller{
        //To Load the Model
        public function model($model){
            $path=__DIR__ .'/../model/'. $model. '.php';
            if (file_exists($path)) {
            require_once $path;
             //Instantiate the model and pass it to the controller member variable
             return new $model();
            } else {
                die("Corresponding View does not exist: $path");
             }
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