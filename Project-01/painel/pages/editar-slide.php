<?php
	if(isset($_GET['id'])){
		$id = (int)$_GET['id'];
		$slide = Painel::Select('tb_site_slides',$id);
	}else{
		Painel::alert('error','Você precisa passar o parametro ID.');
		die();
	}
?>
<div class="box-content">
	<h2><i class="fa fa-pencil"></i> Editar Slide</h2>

	<form method="post" enctype="multipart/form-data">

		<?php
			if(isset($_POST['action'])){
				//Enviei o meu formulário.
				
				$nome = $_POST['nome'];
				$imagem = $_FILES['imagem'];
				$imagem_atual = $_POST['imagem_atual'];
				
				if($imagem['name'] != ''){

					//Existe o upload de imagem.
					if(Painel::ValidateImg($imagem)){
						Painel::DeleteFile($imagem_atual);
						$imagem = Painel::UploadSlide($imagem);
						$arr = ['nome'=>$nome,'slide'=>$imagem['name'],'id'=>$id,'nome_tabela'=>'tb_site_slides'];
						Painel::Update($arr);
						$slide = Painel::Select('tb_site_slides',$id);
						Painel::Alert('success','O Slide foi editado junto com a imagem!');
					}else{
						Painel::Alert('error','O formato da imagem não é válido');
					}
				}else{
					$imagem = $imagem_atual;
					$arr = ['nome'=>$nome,'slide'=>$imagem['name'],'id'=>$id,'nome_tabela'=>'tb_site_slides'];
					Painel::Update($arr);
					$slide = Painel::Select('tb_site_slides',$id);
					Painel::Alert('success','O Slide foi editado com sucesso!');
				}

			}
		?>

		<div class="form-group">
			<label>Nome:</label>
			<input type="text" name="nome" required value="<?php echo $slide['nome']; ?>">
		</div><!--form-group-->


		<div class="form-group">
			<label>Imagem Atual</label>
			<img style="width: 900px;height:500px; margin: 10px 0; border:5px solid black ; box-shadow: 8px 8px 8px black;" src="<?php echo INCLUDE_PATH_PAINEL ?>uploads/<?php echo $slide['slide']; ?>" />
			<label>Imagem</label>
			<input type="file" name="imagem"/>
			<input type="hidden" name="imagem_atual" value="<?php echo $slide['slide']; ?>">
		</div><!--form-group-->

		<div class="form-group">
			<input type="submit" name="action" value="Atualizar!">
		</div><!--form-group-->

	</form>



</div><!--box-content-->