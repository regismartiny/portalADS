<?php
	session_start();
	if (!isset($_SESSION["tipoUsuario"]) || $_SESSION["tipoUsuario"]!=2 || !isset($_COOKIE["702741445"])){
		header( 'Location: /controle/logout.php' );
		return;
	}

?>
	<div class="col mx-auto">
	<h2 class="titulo">Cadastro de Projetos</h2>
		<form id="ajax-form" method='post' action=''>
			<div class="form-group row">
				<label for="titulo" class="col-sm-12 col-md-4 col-form-label">Título</label>
				<div class="col-sm-12 col-md-8">
					<input type="text" class="form-control" id="titulo" name='titulo' required>
				</div>
			</div>
			<div class="form-group row">
				<label for="conteudo" class="col-sm-12 col-md-4 col-form-label">Conteúdo</label>
				<div class="col-sm-12 col-md-8">
					<textarea class="form-control" id="conteudo" name='conteudo' required></textarea>
				</div>
			</div>
			<div class="form-group row">
				<label for="imagem" class="col-sm-12 col-md-4 col-form-label">Link para Imagem</label>
				<div class="col-sm-12 col-md-8">
					<input type="text" class="form-control" id="imagem" name='imagem' required>
				</div>
			</div>
			<div id="result" class="status"></div>
			<br>
			
			
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-6">
					<input type="submit" class="btn-login btn btn-primary btn-lg btn-block" name="botao" value="Adicionar" />
				</div>
				<div class="col-xs-12 col-sm-12 col-md-6">
					
					<input type="reset" class="btn-login btn btn-danger btn-lg btn-block" value="Limpar" />
				</div>
			</div>
			
		</form>						
	</div>
<script>
	$("#ajax-form").submit(function(event) {
		event.preventDefault();

		statusProcessando();

		$.ajax({
			type: "POST",
			url: "/controle/processaCadProjeto.php",
			data: $("#ajax-form").serialize(),
			success: function(response) {
			
				console.log(response);
				let resObj = JSON.parse(response);
				let mensagem = resObj.mensagem;
				statusSucesso(mensagem);
			},
			error: function(response) {
				console.log(response);
				statusErro('Erro no envio do formulário');
			}
		});
	});
</script>