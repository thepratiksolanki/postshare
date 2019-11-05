<?php
/*
 * App Core Class
 * Created URL and loads controller
 * URL FORMAT - /method/controller/params
 */

 class Core{
     protected $currentController = 'pages';
     protected $currentMethod = 'index';
     protected $params = [];

     public function __construct(){
         //print_r($this->getUrl());

         $url = $this->getUrl();

         // Look for controllers in controller
         if(file_exists('../app/controllers/' .ucwords($url[0]).'.php')){
             // If exists, set as current controller
             $this->currentController = ucwords($url[0]);
             unset($url[0]);
         }

         require_once '../app/controllers/' .$this->currentController. '.php';

         $this->currentController = new $this->currentController;

         //Check for second part of URL

         if(isset($url[1])){
             if(method_exists($this->currentController, $url[1])){
                 $this->currentMethod = $url[1];
             }
             unset($url[1]);
         }

         $this->params = $url ? array_values($url) : [];
         call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
     }

     public function getUrl(){
         if(isset($_GET['url'])){
             $url = rtrim($_GET['url'],'/');
             $url = filter_var($url,FILTER_SANITIZE_URL);
             $url = explode('/',$url);
             return $url;
         }
     }
 }