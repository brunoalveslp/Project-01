
<section class="main-banner">
    <div class="banner-slider" style="background-image: url('<?php echo INCLUDE_PATH;?>images/city1.jpg');"></div>
    <div class="banner-slider" style="background-image: url('<?php echo INCLUDE_PATH;?>images/city2.jpg');"></div>
    <div class="banner-slider" style="background-image: url('<?php echo INCLUDE_PATH;?>images/city3.jpg');"></div>

        <div class="overlay"></div>
        <div class="center">

       

        <form method="post">
            <h2>Qual o seu melhor E-mail?</h2>
            <input type="email" name="email" required>
            <input type="hidden" name="id" value="email_sent">
            <input type="submit" name="action" value="Cadastrar!">
        </form>

        <div class="bullets"></div>
        
        </div><!--center-->
    </section><!--main banner-->

    <section id="about" class="author-description">
        <div class="center author">
            <div class="w50 left">
                <h2><?php echo $infoSite['nome_autor']?></h2>
        
                <p>
                <?php echo $infoSite['descricao']?>
                </p>
            </div>
            <div class="w50 right">
                <img class="right" src="<?php echo INCLUDE_PATH?>images/BrunoAlves.jpg" alt="author photografy">
            </div>
            
        </div><!--center-->

    </section><!--author description-->
    <section class="specialities">
    
        <div class="center">
            <h2 class="title">Especialidades</h2>
            <div class="spec">
               
            <div class="box-spec w33">
                <div class="icon"><i class="<?php echo $infoSite['icone1']?>" aria-hidden="true"></i></div>
                
                <h3>HTML5</h3>
                <p>
                <?php echo $infoSite['descricao1']?>
                </p>
            </div>   

            <div class="box-spec w33">
                <div class="icon"><i class="<?php echo $infoSite['icone2']?>" aria-hidden="true"></i></div>
            
                <h3>CSS3</h3>
                <p>
                <?php echo $infoSite['descricao2']?>
                </p>
            </div>  

            <div class="box-spec w33">
                <div class="icon"><i class="<?php echo $infoSite['icone3']?>" aria-hidden="true"></i></div>
            
                <h3>JavaScript</h3>
                <p>
                <?php echo $infoSite['descricao3']?>
                </p>
            </div>
            </div>
        </div><!--center-->
    </section>
    <section class="depositions">
        <div class="center">
            <div class="w50 left">
                <h2>Depoimentos dos Nossos Clientes</h2>

                <?php 
                    $sql = MySql::connect()->prepare("SELECT * FROM `tb_site_depoimentos` ORDER BY order_id LIMIT 3");
                    $sql->execute();
                    $deps = $sql->fetchAll();
                    foreach ($deps as $key => $value) {
                ?>
                <div class="single-dep">
                    <p class="dep">
                      <?php echo $value['depoimentos']?></p>
                    <p class="author-name"><?php echo $value['nome']?><?php $value['data']; ?></p>
                </div>
                    <?php } ?><!--foreach deps-->

            </div><!--w50-->
            <div id="services" class="w50 right">
                <h2>Serviços</h2>
                <?php 
                    $sql = MySql::connect()->prepare("SELECT * FROM `tb_site_servicos` ORDER BY order_id LIMIT 5");
                    $sql->execute();
                    $serv = $sql->fetchAll();
                    foreach ($serv as $key => $value) {
                ?>
                <ul>
                    <li>
                        <?php echo $value['servicos']?>
                    </li>
                    <?php } ?>
                </ul>
            </div><!--w50-->
        </div><!--center-->
    </section>