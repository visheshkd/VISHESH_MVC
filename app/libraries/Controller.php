<?php
/* Every controller we are going to create is going to extend this base controller class / library
* Base Controller
* It loads the models and views
*/
class Controller{
    // it will load model and view
    public function model($model){
        //Require model file
        require_once '../app/models/'. $model . '.php';
        //Instantiate model;
        return new $model(); //e.g  return new Post()

    }
    // We should be able to pass data to the view from database or through dynamic values.
    public function view($view, $data=[]){
        // Check for a view file 
        if(file_exists('../app/views/'. $view . '.php')){
            require_once '../app/views/'. $view . '.php';
        }
        else{
            die('View does not exist');
        }

    }
}