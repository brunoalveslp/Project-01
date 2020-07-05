<?php 
    session_start();
    date_default_timezone_set('America/Sao_Paulo');

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

    const BASE_DIR_PAINEL = __DIR__.'/painel/';

    //database connection
    const HOST = 'localhost';
    const USER = 'root';
    const PASSWORD = '';
    const DATABASE = 'project_01';

    //nome da empresa
    const NOME_EMPRESA = 'Bruno Alves';

    //funcoes painel

    function cargo($cargo)
    {
        $permition = array('0'=>'Normal','1'=>'Sub-Administrador','2'=>'Administrador');
        return $permition[$cargo];
    }

    function selectedMenu($par)
    {
        $url = explode('/',@$_GET['url'])[0];
        if($url == $par)
        {
            echo 'class="menu-active"';
        }
    }

    function verifyPermition($per)
    {
        if($_SESSION['cargo'] <= $per)
        {
            return;
        } else
        {
            echo 'style="display:none;"';
        }
    }

    function permitionPage($per)
    {
        if($_SESSION['cargo'] >= $per)
        {
            return;
        } else
        {
            include(BASE_DIR_PAINEL.'permissao_negada.php');
            die();
        }
    }
?>