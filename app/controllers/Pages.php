<?php
    class Pages extends Controller{
        public function __construct(){

        }

        public function index(){

            if(isLoggedIn()){
                redirect('posts');
            }

            $data = [
                'title' => 'SharePosts',
                'description' => 'Simple social network built on Pratik MVC PHP Framework'
            ];
            $this->view('pages/index', $data);
        }

        public function about(){
            $data = [
                'title' => 'About Us',
                'description' => 'An App to share posts with others'
            ];
            $this->view('pages/about', $data);
        }
    }