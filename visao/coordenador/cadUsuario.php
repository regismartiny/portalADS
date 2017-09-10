<?php
	if(isset($_POST['botao']) && $_POST['botao']=="Adicionar"){
		include_once $_SERVER['DOCUMENT_ROOT']."/portal-ads/controle/ControleUsuario.class.php";
		$uControle = new ControleUsuario();
		$uControle->inserir($_POST);
	}
	
	function inserirTipoUsuarioNoCombo(){
		include_once $_SERVER["DOCUMENT_ROOT"]."/portal-ads/modelo/TipoUsuario.class.php";
		
		$tipoUsuario = new TipoUsuario(null,null);
		$tiposUsuarios = $tipoUsuario->getTipoUsuario();
		$returnTipoUsuarios = "";
		foreach($tiposUsuarios as $row => $arrayInterno){
			$tipoUsuario = new TipoUsuario($arrayInterno['id'],$arrayInterno['descricao']);
			$returnTipoUsuarios = $returnTipoUsuarios."<option value=".$arrayInterno['id'].">".$arrayInterno['descricao']."</option>";
		}
		return $returnTipoUsuarios;
	}	
?>
<html lang='pt-br'>
	<head>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
		<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
		<meta charset='utf-8'>
		<title>Cadastro de Usuarios</title>
	</head>
	<style>
		#container {
			margin-top: 100px;
		}
	</style>
	<body>
		<div class='container-fluid' id="container">
			<div class="row justify-content-center" style='height:100%;'>
				<div class="col-5 ">
					<form method='post' action='cadUsuario.php'>
						<div class="form-group row">
							<h1 class="col-sm-12 col-form-label">Cadastro de Usuários:</h1>
						</div>
						<div class="form-group row">
							<label for="nome" class="col-sm-4 col-form-label">Nome Completo:</label>
							<div class="col-sm-8">
							  <input type="text" class="form-control" id="nome" name='nome' required>
							</div>
						</div>
						<div class="form-group row">
							<label for="matricula" class="col-sm-4 col-form-label">Matricula / SIAPE:</label>
							<div class="col-sm-8">
							  <input type="number" class="form-control" id="matricula" name='matricula' required>
							</div>
						</div>
						<div class="form-group row">
							<label for="email" class="col-sm-4 col-form-label">E-mail (Opcional):</label>
							<div class="col-sm-8">
							  <input type="email" class="form-control" id="email" name='email'>
							</div>
						</div>
						<div class="form-group row">
						<label for="categoria" class="col-sm-4 col-form-label">Tipo:</label>
						<div class="col-sm-8">
							<select class="col custom-select" id="tipoUsuario_id" name="tipoUsuario_id" required>
								<?php 
								echo inserirTipoUsuarioNoCombo();
								?>
							</select>
						</div>
					</div>
						<input type='submit' class='btn btn-primary btn-lg btn-block' name='botao' value='Adicionar'>
					</form>
					<a class='btn btn-danger btn-lg btn-block' href='../index.html'>Cancelar</a>
				</div>
			</div>
		</div>
	</body>
</html>