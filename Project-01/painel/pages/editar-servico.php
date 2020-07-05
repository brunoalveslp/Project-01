<?php 
	if(isset($_GET['id'])){
		$id = (int)$_GET['id'];
		$servico = Painel::select('tb_site_servicos',$id);
	}else{
		Painel::alert('erro','Você precisa passar o parametro ID.');
		die();
	}
 ?>
<div class="box-content">
	<h2><i class="fa fa-pencil"></i> Editar Serviço</h2>

	<form method="post" enctype="multipart/form-data">

		<?php
			if(isset($_POST['action'])){
				if(Painel::update($_POST)){
					Painel::alert('success','O Serviço foi editado com sucesso!');
					echo "<script>alert('O servico foi editado com sucesso!')</script>";
					header("Refresh:0.1");
				}else{
					Painel::alert('error','Campos vázios não são permitidos.');
				}
			}
		?>

		<div class="form-group">
			<label>Serviço:</label>
			<textarea name="servicos" cols="30" rows="10"><?php echo $servico['servicos']; ?></textarea>
		</div><!--form-group-->

	

		<div class="form-group">
			<input type="hidden" name="id" value="<?php echo $id; ?>">
			<input type="hidden" name="nome_tabela" value="tb_site_servicos" />
			<input actionBtn="edit" type="submit" name="action" value="Atualizar!">
		</div><!--form-group-->

	</form>



</div><!--box-content-->