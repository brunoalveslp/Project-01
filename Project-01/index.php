
<?php include('config.php'); ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="Brunoalveslp projects">
    <meta name="description" content="Php project to practice php, html5, css3, mySQL,and more.">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/contact.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:300,400,700" rel="stylesheet">
    <title>Project-01</title>
</head>
<body>
    <header>
        <div class="logo"><a href="">Logomarca</a></div>
            <nav class="desktop">
                
                <ul>
                    <li><a href="<?php echo INCLUDE_PATH;?>">Home</a></li>
                    <li><a href="<?php echo INCLUDE_PATH;?>">Sobre</a></li>
                    <li><a href="<?php echo INCLUDE_PATH;?>">Serviços</a></li>
                    <li><a href="<?php echo INCLUDE_PATH;?>">Contato</a></li>
                </ul>
            </nav><!--header desltop-->
        
            <nav class="mobile">
                <div class="mobile-menu"><i class="fa fa-bars" aria-hidden="true"></i></div>
                <ul>
                    <li><a href="<?php echo INCLUDE_PATH;?>">Home</a></li>
                    <li><a href="<?php echo INCLUDE_PATH;?>">Sobre</a></li>
                    <li><a href="<?php echo INCLUDE_PATH;?>">Serviços</a></li>
                    <li><a href="<?php echo INCLUDE_PATH;?>">Contato</a></li>
                </ul>
            </nav><!--header mobile-->
        
    </header>
    
    <?php 
        
        // $url  = $_SERVER["PHP_SELF"];
        // $path = explode("/", $url); 
        // $last = end($path);
        
        $url = isset($_GET['url']) ? $_GET['url'] : 'home';

        if(file_exists('pages/'.$url.'.php'))
            include('pages/'.$url.'.php');
        else {
            $pagina404 = true;
            include('pages/404.php');
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
</body>
</html>