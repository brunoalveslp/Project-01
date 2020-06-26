
<?php include('config.php'); 

    $url = isset($_GET['url']) ? $_GET['url'] : 'home';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="Brunoalveslp projects">
    <meta name="description" content="Php project to practice php, html5, css3, mySQL,and more.">
    <link rel="stylesheet" href="css/style.css">

    <?php if($url == 'contact'){?>
    <link rel="stylesheet" href="css/contact.css">
    <?php } ?>
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;700&display=swap" rel="stylesheet"> 
    <title>Project-01</title>
</head>
<body>
<?php  

    if(isset($_POST['action']) && $_POST['id'] == 'email_sent')
    {
        if($_POST['email'] != '')
        {
            $email = $_POST['email'];
            if(filter_var($email, FILTER_VALIDATE_EMAIL)){
                //tudo certo
                $mail = new Email('smtp.gmail.com','brunoalvesvoice@gmail.com','Bru456123','project-01');
                $msg = "<hr>Novo Email Cadastrado!</hr>$email";
                $mail->addAdress('brunoalvesvoice@gmail.com','project');
                $info = array('subject'=>'New email registered','body'=>$msg);
                $mail->formatEmail($info);
                if($mail->sendEmail())
                {
                    echo '<script>alert("E-mail Cadastrado!")</script>';
                }else 
                {
                    echo '<script>alert("Algo deu Errado!")</script>';
                }
            }else 
            {
                echo '<script>alert("E-mail Invalido!")</script>';
            }
        }
    }else if(isset($_POST['action']) && $_POST['id'] == 'contact_sent')
    {
        // $name = $_POST['name'];
        // $mail = $_POST['email'];
        // $phone = $_POST['phone'];
        // $message = $_POST['message'];
        $mail = new Email('smtp.gmail.com','brunoalvesvoice@gmail.com','Bru456123','project-01');

        $msg = '';
        foreach($_POST as $key =>$value)
        {
            $msg.=ucfirst($key).": ".$value;
            $msg.='<hr>';
        }
        $mail->addAdress('brunoalvesvoice@gmail.com','project');
        $info = array('subject'=>'New Contact!','body'=>$msg);
        $mail->formatEmail($info);
        if($mail->sendEmail())
        {
            echo '<script>alert("Cotato enviado com sucesso!")</script>';
        }else 
        {
            echo '<script>alert("Algo deu Errado!")</script>';
        }

    }
    else 
    {
        echo '<script>alert("Campos vazios não são permitidos!"")</script>';
    }

?>

    <header>
        <div class="logo"><a href="<?php echo INCLUDE_PATH;?>">Logomarca</a></div>
            <nav class="desktop">

            <?php 
            switch($url){

            case 'about':
                echo '<target target="about"/>';
            break;
            case 'services':
                echo '<target target="services"/>';
            break;
            }
            
            ?>
                
                <ul>
                    <li><a href="<?php echo INCLUDE_PATH;?>">Home</a></li>
                    <li><a href="<?php echo INCLUDE_PATH;?>about">Sobre</a></li>
                    <li><a href="<?php echo INCLUDE_PATH;?>services">Serviços</a></li>
                    <li><a href="<?php echo INCLUDE_PATH;?>contact">Contato</a></li>
                </ul>
            </nav><!--header desltop-->
        
            <nav class="mobile">
                <div class="mobile-menu"><i class="fa fa-bars" aria-hidden="true"></i></div>
                <ul>
                    <li><a href="<?php echo INCLUDE_PATH;?>home">Home</a></li>
                    <li><a href="<?php echo INCLUDE_PATH;?>about">Sobre</a></li>
                    <li><a href="<?php echo INCLUDE_PATH;?>services">Serviços</a></li>
                    <li><a href="<?php echo INCLUDE_PATH;?>contact">Contato</a></li>
                </ul>
            </nav><!--header mobile-->
        
    </header>
    
    <?php 
        
        // $url  = $_SERVER["PHP_SELF"];
        // $path = explode("/", $url); 
        // $last = end($path);

        if(file_exists('pages/'.$url.'.php'))
            include('pages/'.$url.'.php');
        else if($url != 'about' && $url != 'services'){
            $pagina404 = true;
            include('pages/404.php');
        } else {
            include('pages/home.php');
        }
    ?>

    <footer <?php if(isset($pagina404) && $pagina404 == true) echo 'class="fixed"'?>>
        <div class="center">
            <p>©Bruno Alves</p>
            <p>Todos os Direitos Reservados.</p>
        </div><!--center-->
    </footer>


    <script src="js/jquery-3.5.1.min.js"></script>
    <script src="js/script.js"></script>
    <script src="js/slider.js"></script>

    
    
    <?php 
    

    if($url == 'contact'){?>
    
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyDHPNQxozOzQSZ-djvWGOBUsHKBUuT_qH4callback=myMap"></script>
    <!-- <script src="js/map.js"></script> -->
    <?php } ?>
</body>
</html>