<?php 

    $autoload = function($class){
        if($class == 'Email'){
        require_once('classes/phpmailer/PHPMailerAutoLoad.php');
    }
    include('classes/'.$class.'.php');
    };
    
    spl_autoload_register($autoload);

    const INCLUDE_PATH = 'http://localhost/Project-01/';
?>