<?php
/* Base Controller
 * Loads the models and views
 */

class Controller{
    // Load Model
    public function model($model){
        // Require the model file
        require_once('../app/models/'. $model .'.php');

        // Instantiate the model
        return new $model();
    }

    // Load View
    public function view($view, $data = []){
        // Check if file exists
        if(file_exists('../app/views/' .$view. '.php')){
            require_once('../app/views/' .$view. '.php');
        } else {
            die('View does not exist');
        }
    }
}