<?php
	if(isset($_GET['loggout'])){
		Painel::loggout();
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo INCLUDE_PATH_PAINEL ?>css/main.css">
    <link rel="stylesheet" href="<?php echo INCLUDE_PATH ?>css/font-awesome.min.css">
    <title>Control Painel</title>
</head>
<body >
    <div class="menu">
        <div class="menu-wrapper">
        <div class="usuario">
            <?php 
            if(isset($_SESSION['img']) == ''){ ?>
            <div class="avatar-usuario">
               <i class="fa fa-user"></i> 
            </div>
            <?php } else {?>
                <div class="avatar-usuario">
               <img src="<?php echo INCLUDE_PATH_PAINEL ?>uploads/"<?php echo $_SESSION['img'];?>>
            </div>
            <?php }?>
            <div class="nome-usuario">
                <p><?php echo $_SESSION['nome'];?></p>
                <p><?php echo cargo($_SESSION['cargo']);?></p>
        </div><!-- nome-usuario -->
        </div> <!--usuario -->
        </div><!--menu-wrapper -->

    </div><!--menu -->

    <header>
    <div class="center">
        <div class="menu-btn">
			<i class="fa fa-bars"></i>
	    </div><!--menu-btn-->
    <div class="loggout">
			<a <?php if(@$_GET['url'] == ''){ ?> style="background: #60727a;padding: 15px;" <?php } ?> href="<?php echo INCLUDE_PATH_PAINEL ?>"> <i class="fa fa-home"></i> <span>Página Inicial</span></a>
			<a href="<?php echo INCLUDE_PATH_PAINEL ?>?loggout"> <i class="fa fa-window-close"></i> <span>Sair</span></a>
		</div><!--loggout-->
        <div class="clear"></div>
            
    </div>
    </header>
    <div class="content">
            <div class="box-content left w100">
            
            </div>
            <div class="box-content left w100">
                
            </div>
            <div class="box-content left w50">
                
            </div>
            <div class="box-content right w50">
                
            </div>
        <div class="clear"></div><!--clear -->
    </div>

    <script src="<?php echo INCLUDE_PATH ?>js/jquery-3.5.1.min.js"></script>
    <script src="<?php echo INCLUDE_PATH_PAINEL ?>js/main.js"></script>
</body>
</html>