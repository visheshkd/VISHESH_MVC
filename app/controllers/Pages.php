<?php
    class Pages extends Controller {
        public function __construct(){
        }
        public function index(){
        $data = [
            'title'=>'Vishesh_MVC'
        ];

        $this->view('Pages/index', $data);
        //above , passed the 'title' value to the view from controller.
        }
        public function about(){
         $data = [
                'title'=>'About'
            ];

        $this->view('Pages/about', $data);
        }
    }