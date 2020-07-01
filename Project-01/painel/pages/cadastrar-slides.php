<div class="box-content">
	<h2><i class="fa fa-pencil"></i> Cadastrar Slide</h2>

	<form method="post" enctype="multipart/form-data">

		<?php

			if(isset($_POST['action'])){
				$nome = $_POST['nome'];
				$imagem = $_FILES['imagem'];
				if($nome == ''){
					Painel::Alert('error','O campo nome não pode ficar vázio!');
				}else{
					//Podemos cadastrar!
					if(Painel::ValidateImg($imagem) == false){
						Painel::Alert('error','O formato especificado não está correto!');
					}else{
						//Apenas cadastrar no banco de dados!
						//include('../classes/lib/WideImage.php');
						$imagem = Painel::UploadSlide($imagem);
						//WideImage::load('uploads/'.$imagem)->resize(100)->rotate(180)->saveToFile('uploads/'.$imagem);
						$orderid = '0';
						$arr = ['nome'=>"$nome",'slide'=>$imagem['name'],'order_id'=>$orderid,'nome_tabela'=>'tb_site_slides'];
						Painel::Insert($arr);
						Painel::Alert('success','O cadastro do slide foi realizado com sucesso!');
					}
				}
				
			}
		?>
		<div class="form-group">
			<label>Nome</label>
			<input type="text" name="nome"/>
		</div><!--form-group-->

		<div class="form-group">
			<label>Imagem</label>
			<input type="file" name="imagem"/>
		</div><!--form-group-->

		<div class="form-group">
			<input type="submit" name="action" value="Cadastrar!">
		</div><!--form-group-->

	</form>



</div><!--box-content-->