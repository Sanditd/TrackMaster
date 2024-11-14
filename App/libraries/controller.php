<?php
    class controller{
        //To Load the Model
        public function model($model){
            require_once '../App/models/'. $model. '.php';
            //Instantiate the model and pass it to the controller member variable
            return new $model();
        }

    //To Load the View
        public function view($view){
            if(file_exists('../App/views/'.$view.'.php')){
                require_once '../App/views/'. $view. '.php';
            }
            else{
                die('Corresponding View does not exist');
            }
        }
    }

?>