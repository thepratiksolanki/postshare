<?php
    ini_set('display_errors', 1);
    // Load Config

    require_once 'config/config.php';

    // Load Helper Classes

    require_once 'helpers/url_helper.php';
    require_once 'helpers/session_helper.php';
    
    // Autoload Libraries

    spl_autoload_register(function($className){
        require_once 'libraries/' .$className. '.php';
    });