<div class="box-content">
	<h2><i class="fa fa-pencil"></i> Editar Usuário</h2>

	<form method="post" enctype="multipart/form-data">

		<?php
			if(isset($_POST['action']))
			{	
				$name = $_POST['name'];
				$pass = $_POST['password'];
				$img = $_FILES['image'];
				$curImg = $_SESSION['img'];

				if($img['name'] != '')
				{
					//if the image is a valid image
					if(Painel::validateImg($img))
					{
						$_SESSION['img']=$img['name'];
						Painel::deleteFile($curImg);
						Painel::uploadFile($img);
						if(User::refreshUser($name,$pass,$img))
						{
							Painel::alert('success','Edição Realizada Com Sucesso');
							header('refresh: 1');
						} else
						{
							Painel::alert('error','Formato Invalido!');
						}
					}
					

				} else 
				{
					$img = $curImg;
					if(User::refreshUser($name,$pass,$img))
					{
						Painel::alert('success','Edição Realizada Com Sucesso!');
					} else
					{
						Painel::alert('error','Ocorreu um erro durante a Edição!');
					}
				}
				
			}
		?>

		<div class="form-group">
			<label>Nome:</label>
			<input type="text" name="name" required value="<?php echo $_SESSION['nome']; ?>">
		</div><!--form-group-->
		<div class="form-group">
			<label>Senha:</label>
			<input type="password" name="password" value="<?php echo $_SESSION['password']; ?>" required>
		</div><!--form-group-->

		<div class="form-group">
			<label>Imagem</label>
			<input type="file" name="image"/>
			<input type="hidden" name="curImg" value="<?php echo $_SESSION['img']; ?>">
		</div><!--form-group-->

		<div class="form-group">
			<input type="submit" name="action" value="Atualizar!">
		</div><!--form-group-->

	</form>



</div><!--box-content-->