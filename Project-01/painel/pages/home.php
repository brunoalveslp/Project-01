<?php
	$usersOnline = Painel::listUsers();

	$Visits = MySql::connect()->prepare("SELECT * FROM `tb_admin_visitas`");
	$Visits->execute();
	$Visits = $Visits->rowCount();

	$VisitsToday = MySql::connect()->prepare("SELECT * FROM `tb_admin_visitas` WHERE dia = ?");
	$VisitsToday->execute(array(date('y-m-d')));
	$VisitsToday = $VisitsToday->rowCount();


?>
<div class="box-content w100">
		<h2><i class="fa fa-home"></i> Painel de Controle - <?php echo NOME_EMPRESA ?></h2>

		<div class="box-metricas">
			<div class="box-metrica-single">
				<div class="box-metrica-wraper">
					<h2>Usuários Online</h2>
					<p><?php echo count($usersOnline); ?></p>
				</div><!--box-metrica-wraper-->
			</div><!--box-metrica-single-->
			<div class="box-metrica-single">
				<div class="box-metrica-wraper">
					<h2>Total de Visitas</h2>
					<p><?php echo $Visits; ?></p>
				</div><!--box-metrica-wraper-->
			</div><!--box-metrica-single-->
			<div class="box-metrica-single">
				<div class="box-metrica-wraper">
					<h2>Visitas Hoje</h2>
					<p><?php echo $VisitsToday; ?></p>
				</div><!--box-metrica-wraper-->
			</div><!--box-metrica-single-->
			<div class="clear"></div>
		</div><!--box-metricas-->

</div><!--box-content-->

<div class="box-content w100 left">
<h2><i class="fa fa-rocket" aria-hidden="true"></i> Usuários Online no Site</h2>

	<div class="table-responsive">
		<div class="row">
			<div class="col">
				<span>IP</span>
			</div><!--col-->
			<div class="col">
				<span>Última Ação</span>
			</div><!--col-->
			<div class="clear"></div>
		</div><!--row-->

		<?php
			foreach ($usersOnline as $key => $value) {

		?>
		<div class="row">
			<div class="col">
				<span><?php echo $value['ip'] ?></span>
			</div><!--col-->
			<div class="col">
				<span><?php echo date('d/m/Y H:i:s',strtotime($value['ultima_acao'])) ?></span>
			</div><!--col-->
			<div class="clear"></div>
		</div><!--row-->
		<?php } ?>
	</div><!--table-responsive-->
</div><!--box-content-->

<div class="box-content w100 left">
<h2><i class="fa fa-rocket" aria-hidden="true"></i> Usuários do Painel</h2>

	<div class="table-responsive">
		<div class="row">
			<div class="col">
				<span>Nome</span>
			</div><!--col-->
			<div class="col">
				<span>Cargo</span>
			</div><!--col-->
			<div class="clear"></div>
		</div><!--row-->

		<?php
			$usuariosPainel = MySql::connect()->prepare("SELECT * FROM `tb_admin_users`");
			$usuariosPainel->execute();
			$usuariosPainel = $usuariosPainel->fetchAll();
			foreach ($usuariosPainel as $key => $value) {

		?>
		<div class="row">
			<div class="col">
				<span><?php echo $value['user'] ?></span>
			</div><!--col-->
			<div class="col">
				<span><?php echo cargo($value['cargo']); ?></span>
			</div><!--col-->
			<div class="clear"></div>
		</div><!--row-->
		<?php } ?>
	</div><!--table-responsive-->
</div><!--box-content-->

<div class="clear"></div>