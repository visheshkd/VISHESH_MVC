<?php

/*
* APP CORE CLASS
*CREATES URL & loads core controller
*URL FORMAT : controller/method/params
*/

class Core{
    protected $currentController = 'Pages';
    protected $currentMethod = 'index';
    protected $params  = [];

    public function __construct(){
        //print_r($this->getUrl());

        $url = $this->getUrl();

        //STEPS BELOW ARE FOR CONTROLLER AND ITS INSTANTIATION.

        // look in controllers for first value
        if(file_exists('../app/controllers/' . ucwords($url[0]) . '.php')){
            //if exists , set it to the current controller
            $this->currentController = ucwords($url[0]);
            // Unset zero index
            unset($url[0]);
        }

        //require the controller
        require_once '../app/controllers/'. $this->currentController . '.php';

        //instantiate controller class
        $this->currentController = new $this->currentController; 
        // E.g Posts = new Posts(); -> controller class.

        //Look for the second part of the url --> method

        if(isset($url[1])){
            // Check to see if method exists in controller
            if(method_exists($this->currentController, $url[1])){
                $this->currentMethod = $url[1];   
                // Unset 1 index
                unset($url[1]);

            }
        }
        //echo $this->currentMethod;

        //Get params
        $this->params = $url ? array_values($url) : [];
        //call a callback with an array of params
        call_user_func_array([$this->currentController, $this->currentMethod],$this->params);

    }

    // we want to fetch data/word from the url . so creating a function

    public function getUrl(){
        if(isset($_GET['url'])){
            //trim
            $url = rtrim($_GET['url'], '/');
            //filtering the url - sanitize
            $url = filter_var($url, FILTER_SANITIZE_URL);
            //explode fn for taking out params from url after'/'
            $url = explode('/', $url);
            return $url;
        }
    }
}

