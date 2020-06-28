<?php 
    session_start();

    $autoload = function($class)
    {
        if($class == 'Email')
        {
        require_once('classes/phpmailer/PHPMailerAutoLoad.php');
        }
        include('classes/'.$class.'.php');
    };
    
    spl_autoload_register($autoload);

    const INCLUDE_PATH = 'http://localhost/Project-01/';
    const INCLUDE_PATH_PAINEL = INCLUDE_PATH.'painel/';

    //database connection
    const HOST = 'localhost';
    const USER = 'root';
    const PASSWORD = '';
    const DATABASE = 'project_01';

    function cargo($cargo)
    {
        $arr = ['0'=>'Blogger','1'=>'Sub-Administrador','2'=>'Administrador'];
        return $arr[$cargo];
    }
?>