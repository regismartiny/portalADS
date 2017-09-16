<?php
	if(isset($_POST['botao']) && $_POST['botao']=="Trocar Senha"){
		if()
		
		include_once $_SERVER['DOCUMENT_ROOT']."/portal-ads/controle/ControleUsuario.class.php";
		$uControle = new ControleUsuario();
		$uControle->inserir($_POST);
	}
	
	
?>
<html lang='pt-br'>
	<head>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
		<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
		<meta charset='utf-8'>
		<title>Trocar Senha de Usuario</title>
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
							<h1 class="col-sm-12 col-form-label">Trocar Senha de Usuario:</h1>
						</div>
						<div class="form-group row">
							<label for="senha" class="col-sm-5 col-md-5 col-form-label">Senha:</label>
							<div class="col-sm-7 col-md-7">
								<input type="password" class="form-control" id="senha" name="senha" required>
							</div>
						</div>
						<div class="form-group row">
							<label for="senha" class="col-sm-5 col-md-5 col-form-label"> Confirmação de Senha:</label>
							<div class="col-sm-7 col-md-7">
								<input type="password" class="form-control" id="senha" name="senha" required>
							</div>
						</div>
					</div>
						<input type='submit' class='btn btn-primary btn-lg btn-block' name='botao' value='Trocar Senha'>
					</form>
					<a class='btn btn-danger btn-lg btn-block' href='../index.html'>Cancelar</a>
				</div>
			</div>
		</div>
	</body>
</html>