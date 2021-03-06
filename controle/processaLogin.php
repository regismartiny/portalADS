<?php
    // required headers
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


    if (!empty($_POST) && isset($_POST['matricula']) && isset($_POST['senha'])
            && !empty($_POST['matricula']) && !empty($_POST['senha'])) {
        include $_SERVER['DOCUMENT_ROOT']."/controle/ControleUsuario.class.php";
        include $_SERVER['DOCUMENT_ROOT']."/controle/Util.php";

        $dados = clearArray($_POST);

        $cUsuario = new ControleUsuario();

        $status = array();
        $validacao = $cUsuario->validarLogin($dados['matricula'], $dados['senha']);

        if ($validacao == 2 || $validacao == 5) { //login ok
            session_start();
            $usuario = new Usuario(null, $dados['matricula']);
            $usuario->listarUmPorSiapeMatricula();
            $_SESSION['usuario_id'] = $usuario->getId();
            $_SESSION['primeiroAcesso'] = true;
        }

        if($validacao == 2) {
            //acesso normal
            $_SESSION['nomeUsuario'] = $usuario->getNome();
            $_SESSION['matricula'] = $usuario->getSiapeMatricula();
            $_SESSION['email'] = $usuario->getEmail();
            $_SESSION['tipoUsuario'] = $usuario->getTipoUsuario_id();
            $_SESSION['dataUltimoAcesso'] = $usuario->getDataUltimoAcesso();
            
            $cookie_name = "702741445";
            $cookie_value = $_SESSION['matricula'];
            setcookie($cookie_name, $cookie_value, time() + 3600, "/");


            $status = array('sucesso' => true, 'mensagem' => 'Usuário autenticado com sucesso.', 'tipoUsuario' => $_SESSION['tipoUsuario']);
            
        } elseif ($validacao == 0) {
            $status = array('sucesso' => false, 'mensagem' => 'Erro desconhecido.');
        } elseif ($validacao == 1) {
            //Usuário Certo, Senha Errada
            $status = array('sucesso' => false, 'mensagem' => 'Senha inválida.');
        } elseif ($validacao == 3) {
            $status = array('sucesso' => false, 'mensagem' => 'O usuário não existe.');
        } elseif ($validacao == 4){
            //usuario bloqueado
            $status = array('sucesso' => false, 'mensagem' => 'O usuário está bloqueado.');
        } elseif ($validacao == 5){
            //primeiro acesso
            $status = array('sucesso' => true, 'mensagem' => 'Primeiro acesso. Você deve alterar a senha e cadastrar seu email.', 'primeiroAcesso' => true);
        }	
        $resultado = json_encode($status, JSON_FORCE_OBJECT);
        echo json_encode($resultado);
    }
?>