<?php
	permitionPage(2);
	
?>
<div class="box-content">
	<h2><i class="fa fa-pencil"></i> Adicionar Usuário</h2>

	<form method="post" enctype="multipart/form-data">

		<?php
			if(isset($_POST['action'])){
				$login = $_POST['login'];
				$nome = $_POST['nome'];
				$senha = $_POST['password'];
				$imagem = $_FILES['imagem'];
				$cargo = $_POST['cargo'];

				if($login == ''){
					Painel::alert('error','O login está vázio!');
				}else if($nome == ''){
					Painel::alert('error','O nome está vázio!');
				}else if($senha == ''){
					Painel::alert('error','A senha está vázia!');
				}else if($cargo == ''){
					Painel::alert('error','O cargo precisa estar selecionado!');
				}else{
					//Podemos cadastrar!
					if($cargo >= $_SESSION['cargo']){
						Painel::alert('erro','Você precisa selecionar um cargo menor que o seu!');
					}else if(Painel::validateImg($imagem) == false || $imagem == ''){
						Painel::alert('erro','O formato especificado não está correto!');
					}else if(User::userExists($login)){
						Painel::alert('erro','O login já existe, selecione outro por favor!');
					}else{
						//Apenas cadastrar no banco de dados!
						$imagem = Painel::uploadFile($imagem);
						User::newUser($login,$senha,$imagem,$nome,$cargo);
						Painel::alert('sucesso','O cadastro do usuário '.$login.' foi feito com sucesso!');
					}
				}
				
				
			}
		?>

		<div class="form-group">
			<label>Login:</label>
			<input type="text" name="login">
		</div><!--form-group-->

		<div class="form-group">
			<label>Nome:</label>
			<input type="text" name="nome">
		</div><!--form-group-->
		<div class="form-group">
			<label>Senha:</label>
			<input type="password" name="password">
		</div><!--form-group-->

		<div class="form-group">
			<label>Cargo:</label>
			<select name="cargo">
				<?php
					foreach (Painel::$Permition as $key => $value) {
						if($key <= $_SESSION['cargo']) echo '<option value="'.$key.'">'.$value.'</option>';
					}
				?>
			</select>
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