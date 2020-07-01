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
                <img src="<?php echo INCLUDE_PATH_PAINEL ?>uploads/<?php echo $_SESSION['img'] ?>" />
                
            </div>
            <?php }?>
            <div class="nome-usuario">
                <p><?php echo $_SESSION['nome'];?></p>
                <p><?php echo cargo($_SESSION['cargo']);?></p>
        </div><!-- nome-usuario -->
        </div> <!--usuario -->
        </div><!--menu-wrapper -->
        <div class="items-menu">
		<h2>Cadastro</h2>
		<a <?php selectedMenu('cadastrar-depoimento'); ?> href="<?php echo INCLUDE_PATH_PAINEL ?>cadastrar-depoimento">Cadastrar Depoimento</a>
		<a <?php SelectedMenu('cadastrar-servico'); ?> href="<?php echo INCLUDE_PATH_PAINEL ?>cadastrar-servico">Cadastrar Serviço</a>
		<a <?php SelectedMenu('cadastrar-slides'); ?> href="<?php echo INCLUDE_PATH_PAINEL ?>cadastrar-slides">Cadastrar Slides</a>
		<h2>Gestão</h2>
		<a <?php SelectedMenu('listar-depoimentos'); ?> href="<?php echo INCLUDE_PATH_PAINEL ?>listar-depoimentos">Listar Depoimentos</a>
		<a <?php SelectedMenu('listar-servicos'); ?> href="<?php echo INCLUDE_PATH_PAINEL ?>listar-servicos">Listar Serviços</a>
		<a <?php SelectedMenu('listar-slides'); ?> href="<?php echo INCLUDE_PATH_PAINEL ?>listar-slides">Listar Slides</a>
		<h2>Administração do painel</h2>
		<a <?php SelectedMenu('editar-usuario'); ?> href="<?php echo INCLUDE_PATH_PAINEL ?>editar-usuario">Editar Usuário</a>
		<a <?php SelectedMenu('adicionar-usuario'); ?> <?php VerifyPermition(2); ?> href="<?php echo INCLUDE_PATH_PAINEL ?>adicionar-usuario">Adicionar Usuário</a>
		<h2>Configuração Geral</h2>
		<a <?php SelectedMenu('editar-site'); ?> href="<?php echo INCLUDE_PATH_PAINEL ?>editar-site">Editar Site</a>
	</div><!--items-menu-->

    </div><!--menu -->

    <header>
    <div class="center">
        <div class="menu-btn">
			<i class="fa fa-bars"></i>
	    </div><!--menu-btn-->
    <div class="loggout">
			<a <?php if(@$_GET['url'] == ''){ ?> style="background: #60727a;padding: 15px;" <?php } ?> href="<?php echo INCLUDE_PATH_PAINEL ?>"> <i class="fa fa-home"></i> <span>Página Inicial do Painel</span></a>
            <a <?php if(@$_GET['url'] == ''){ ?> style="background: #60727a;padding: 15px;" <?php } ?> href="<?php echo INCLUDE_PATH ?>"> <i class="fa fa-home"></i> <span>Home Site</span></a>
			<a href="<?php echo INCLUDE_PATH_PAINEL ?>?loggout"> <i class="fa fa-window-close"></i> <span>Sair</span></a>
		</div><!--loggout-->
        <div class="clear"></div>
            
    </div>
    </header>
    <div class="content">
    
    <?php Painel::LoadPage(); ?>
            
        <div class="clear"></div><!--clear -->
    </div>

    <script src="<?php echo INCLUDE_PATH ?>js/jquery-3.5.1.min.js"></script>
    <script src="<?php echo INCLUDE_PATH_PAINEL ?>js/main.js"></script>
    <script src="<?php echo INCLUDE_PATH_PAINEL ?>js/jquery.mask.js"></script>
</body>
</html>