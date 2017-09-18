<?php
include $_SERVER['DOCUMENT_ROOT']."/modelo/Usuario.class.php";

class ControleUsuario
{
    public function verificaUser($dados)
    {
        $usuario = new Usuario(null, $dados['matricula'], null, null, $dados['senha'], null, null);
        $cadastrado = $usuario->isCadastrado();
        return $cadastrado;
    }
    
    public function listarUm($dados)
    {
        $usuario = new Usuario(null, $dados['matricula'], null, null, null, null, null);
        $usuario->listarUm();
		return $usuario;
    }

    public function inserir($dados)
    {
        $usuario = new Usuario(null, $dados['matricula'], $dados['nome'], $dados['email'], '123456789', 1, $dados['tipoUsuario_id']);
        $usuario->inserir();
    }
	
    public function consultar()
    {   
        $usuario = new Usuario();
        return $usuario->listarTodos();
    }
	
    public function desabilitarUsuario($id){
        $usuario = new Usuario($id, null, null, null, null, 0, null);
        $usuario->desabilitarUsuario();
    }
}
