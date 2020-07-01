<?php
	if(isset($_GET['excluir'])){
		$idExcluir = intval($_GET['excluir']);
		Painel::Delete('tb_site_servicos',$idExcluir);
		Painel::Redirect(INCLUDE_PATH_PAINEL.'listar-servicos');
	}else if(isset($_GET['order']) && isset($_GET['id'])){
		Painel::OrderItem('tb_site_servicos',$_GET['order'],$_GET['id']);
	}

	$paginaAtual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
	$porPagina = 4;
	
	$servicos = Painel::SelectAll('tb_site_servicos',($paginaAtual - 1) * $porPagina,$porPagina);
	
?>
<div class="box-content">
	<h2><i class="fa fa-id-card-o" aria-hidden="true"></i> Serviços Cadastrados</h2>
	<div class="wraper-table">
	<table>
		<tr>
			<td>Serviço</td>
			<td>Editar</td>
			<td>Excluir</td>
			<td>Ordenar</td>
			<td>Ordenar</td>
		</tr>

		<?php
			foreach ($servicos as $key => $value) {
		?>
		<tr>
			<td><?php echo $value['servicos']; ?></td>
			<td><a class="btn edit" href="<?php echo INCLUDE_PATH_PAINEL ?>editar-servico?id=<?php echo $value['id']; ?>"><i class="fa fa-pencil"></i> Editar</a></td>
			<td><a actionBtn="delete" class="btn delete" href="<?php echo INCLUDE_PATH_PAINEL ?>listar-servicos?excluir=<?php echo $value['id']; ?>"><i class="fa fa-times"></i> Excluir</a></td>
			<td><a class="btn order" href="<?php echo INCLUDE_PATH_PAINEL ?>listar-servicos?order=up&id=<?php echo $value['id'] ?>"><i class="fa fa-angle-up"></i></a></td>
			<td><a class="btn order" href="<?php echo INCLUDE_PATH_PAINEL ?>listar-servicos?order=down&id=<?php echo $value['id'] ?>"><i class="fa fa-angle-down"></i></a></td>
		</tr>

		<?php } ?>

	</table>
	</div>

	<div class="paginacao">
		<?php
			$totalPaginas = ceil(count(Painel::SelectAll('tb_site_servicos')) / $porPagina);

			for($i = 1; $i <= $totalPaginas; $i++){
				if($i == $paginaAtual)
					echo '<a class="page-selected" href="'.INCLUDE_PATH_PAINEL.'listar-servicos?pagina='.$i.'">'.$i.'</a>';
				else
					echo '<a href="'.INCLUDE_PATH_PAINEL.'listar-servicos?pagina='.$i.'">'.$i.'</a>';
			}

		?>
	</div><!--paginacao-->


</div><!--box-content-->