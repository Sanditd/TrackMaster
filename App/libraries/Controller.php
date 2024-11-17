<?php
    class Controller{
        //public function model($model){
        //    require_once '../model/'.$model.'.php';

            //init model pass it
          //  return new $model();
        //}

        public function view($view) {
            $path = __DIR__ . '/../views/Admin/' . $view . '.php'; // Use absolute path
            if (file_exists($path)) {
                //echo "yes";
                require_once $path;
            } else {
                die("View does not exist: " . $path);
            }
        }
        
    }
?>