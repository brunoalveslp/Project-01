<?php 
	if(isset($_GET['id'])){
		$id = (int)$_GET['id'];
		$depoimento = Painel::select('tb_site_depoimentos',$id);
	}else{
		Painel::alert('erro','Você precisa passar o parametro ID.');
		die();
	}
 ?>
<div class="box-content">
	<h2><i class="fa fa-pencil"></i> Editar Depoimento</h2>

	<form method="post" enctype="multipart/form-data">

		<?php
			if(isset($_POST['action'])){
				if(Painel::update($_POST)){
					Painel::alert('success','O depoimento foi editado com sucesso!');
					echo "<script>alert('O depoimento foi editado com sucesso!')</script>";
					header("Refresh:0.1");
				}else{
					Painel::alert('error','Campos vázios não são permitidos.');
				}
			}
		?>

		<div class="form-group">
			<label>Nome da pessoa:</label>
			<input type="text" name="nome" value="<?php echo $depoimento['nome']; ?>">
		</div><!--form-group-->

		<div class="form-group">
			<label>Depoimento:</label>
			<textarea name="depoimentos"><?php echo $depoimento['depoimentos']; ?></textarea>
		</div><!--form-group-->

		<div class="form-group">
			<label>Data:</label>
			<input formato="data" type="text" name="data" value="<?php echo $depoimento['data']; ?>">
		</div><!--form-group-->

		<div class="form-group">
			<input type="hidden" name="id" value="<?php echo $id; ?>">
			<input type="hidden" name="nome_tabela" value="tb_site_depoimentos" />
			<input actionBtn="edit" type="submit" name="action" value="Atualizar!">
		</div><!--form-group-->

	</form>



</div><!--box-content-->