<?php
include_once $_SERVER['DOCUMENT_ROOT']."/db/MySQL.class.php";

class Usuario implements JsonSerializable{

    private $id;
    private $siapeMatricula;
    private $nome;
    private $email;
    private $senha;
    private $status;
    private $tipoUsuario_id;
	private $dataUltimoAcesso;
        
    public function __construct($id = null, $si = null, $n = null, $e = null, $se = null, $st = null, $tp = null, $dua= null) {
        $this->id = $id;
        $this->siapeMatricula = $si;
        $this->nome = $n;
        $this->email = $e;
        $this->senha = $se;
        $this->status = $st;
        $this->tipoUsuario_id = $tp;
		$this->dataUltimoAcesso = $dua;
    }
        
    public function getId() {
        return $this->id;
    }
        
    public function setId($id) {
        $this->id = $id;
    }
        
    public function getSiapeMatricula() {
        return $this->siapeMatricula;
    }
        
    public function setSiapeMatricula($siapeMatricula) {
        $this->siapeMatricula = $siapeMatricula;
    }
        
    public function getNome() {
        return $this->nome;
    }
        
    public function setNome($nome) {
        $this->nome = $nome;
    }
        
    public function getEmail() {
        return $this->email;
    }
        
    public function setEmail($email) {
        $this->email = $email;
    }
        
    public function getSenha() {
        return $this->senha;
    }
        
    public function setSenha($senha) {
        $this->senha = $senha;
    }
        
    public function getStatus() {
        return $this->status;
    }
        
    public function setStatus($status) {
        $this->status = $status;
    }
        
    public function getTipoUsuario_id() {
        return $this->tipoUsuario_id;
    }
        
    public function setTipoUsuario_id($tipoUsuario_id) {
        $this->tipoUsuario_id = $tipoUsuario_id;
    }
	
	public function getDataUltimoAcesso() {
        return $this->dataUltimoAcesso;
    }
        
    public function setDataUltimoAcesso($dua) {
        $this->dataUltimoAcesso = $dua;
    }
	
    public function isAtivo() {
        return $this->status == 1;
    }

    public function listarUm() {
        $con = new MySQL();
        $sql = "SELECT * FROM Usuario WHERE id='$this->id'";
        $resultado = $con->consulta($sql);
        if (!empty($resultado)) {
            $this->id = $resultado[0]["id"];
            $this->siapeMatricula = $resultado[0]["siapeMatricula"];
            $this->nome = $resultado[0]["nome"];
            $this->email = $resultado[0]["email"];
            $this->senha = $resultado[0]["senha"];
            $this->status = $resultado[0]["status"];
            $this->tipoUsuario_id = $resultado[0]["TipoUsuario_id"];
            return true;	
        } else {
            return false;
        }
    }

    public function listarUmPorSiapeMatricula() {
        $con = new MySQL();
        $sql = "SELECT * FROM Usuario WHERE siapeMatricula='$this->siapeMatricula'";
        $resultado = $con->consulta($sql);
        if (!empty($resultado)) {
            $this->id = $resultado[0]["id"];
            $this->siapeMatricula = $resultado[0]["siapeMatricula"];
            $this->nome = $resultado[0]["nome"];
            $this->email = $resultado[0]["email"];
            $this->senha = $resultado[0]["senha"];
            $this->status = $resultado[0]["status"];
            $this->tipoUsuario_id = $resultado[0]["TipoUsuario_id"];
			$this->dataUltimoAcesso = $resultado[0]["dataUltimoAcesso"];
            return true;	
        } else {
            return false;
        }
    }
	
	public function listarUmPorEmail() {
        $con = new MySQL();
        $sql = "SELECT * FROM Usuario WHERE email='$this->email' AND id!='$this->id'";
        $resultado = $con->consulta($sql);
        if (!empty($resultado)) {
            $this->id = $resultado[0]["id"];
            $this->numero = $resultado[0]["siapeMatricula"];
            $this->nome = $resultado[0]["nome"];
            $this->email = $resultado[0]["email"];
            $this->status = $resultado[0]["status"];
            $this->tipoUsuario_id = $resultado[0]["TipoUsuario_id"];
			$this->dataUltimoAcesso = $resultado[0]["dataUltimoAcesso"];
            return true;	
        } else {
            return false;
        }
    }
        
    public function listarTodos() {
        $con = new MySQL();
        $sql = "SELECT * FROM Usuario";
        $resultados = $con->consulta($sql);
        if (!empty($resultados)) {
            $usuarios = array();
            foreach ($resultados as $resultado) {
                $usuario = new Usuario();
                $usuario->setId($resultado['id']);
                $usuario->setSiapeMatricula($resultado['siapeMatricula']);
                $usuario->setNome($resultado['nome']);
                $usuario->setEmail($resultado['email']);
                $usuario->setSenha($resultado['senha']);
                $usuario->setStatus($resultado['status']);
                $usuario->setTipoUsuario_id($resultado['TipoUsuario_id']);
				$usuario->setDataUltimoAcesso($resultado['dataUltimoAcesso']);
                $usuarios[] = $usuario;
            }
            return $usuarios;
        }else {
            return false;
        }
    }
	
    public function filtrarUsuario() {
        $con = new MySQL();
        $sql = "SELECT * FROM Usuario WHERE id='$this->id'";
        $resultados = $con->consulta($sql);
        if (!empty($resultados)) {
            $usuarios = array();
            foreach ($resultados as $resultado){
                $usuario = new Usuario();
                $usuario->setId($resultado['id']);
                $usuario->setSiapeMatricula($resultado['siapeMatricula']);
                $usuario->setNome($resultado['nome']);
                $usuario->setEmail($resultado['email']);
                $usuario->setSenha($resultado['senha']);
                $usuario->setStatus($resultado['status']);
                $usuario->setTipoUsuario_id($resultado['TipoUsuario_id']);
				$usuario->setDataUltimoAcesso($resultado['dataUltimoAcesso']);
                $usuarios[] = $usuario;
            }
            return $usuarios;
        }else {
            return false;
        }
    }	
         
    public function inserir() {
        $resposta = 0;
        $con = new MySQL();
        $sql = "SELECT * FROM Usuario WHERE siapeMatricula = '$this->siapeMatricula'";
        $resultados = $con->consulta($sql);
        if (count($resultados) == 0) {
            if(strlen($this->email) > 0) {
                $sql = "SELECT * FROM Usuario WHERE email = '$this->email'";
                $resultados2 = $con->consulta($sql);

                if (count($resultados2) == 0) {//tudo certo
                    $sql = "INSERT INTO Usuario (siapeMatricula,nome,email,senha,status,TipoUsuario_id) VALUES ('$this->siapeMatricula','$this->nome','$this->email','$this->senha','$this->status','$this->tipoUsuario_id')";
                    $con->executa($sql);
                    $resposta = 1;

                }else {
                    //Email ja existe
                    $resposta = 2;
                }
            }else {
                $sql = "INSERT INTO Usuario (siapeMatricula,nome,email,senha,status,TipoUsuario_id) VALUES ('$this->siapeMatricula','$this->nome',null,'$this->senha','$this->status','$this->tipoUsuario_id')";
                $con->executa($sql);
                $resposta = 1;
            }
        }else {
            //Matricula ja existe
	        $resposta = 3;
	    }
	    return $resposta;
    }
	
    public function modificarStatus() {
        $status = $this->getStatus();
        $con = new MySQL();
        if ($status == 1) {
            $sql = "UPDATE Usuario SET status = 0 WHERE id = '$this->id'";
        }else {
            $sql = "UPDATE Usuario SET status = 1 WHERE id = '$this->id'";
        }
        return $con->executa($sql) > 0;
    }
	
    public function atualizar() {
        $con = new MySQL();		
        $sql = "UPDATE Usuario SET siapeMatricula = COALESCE(".(is_null($this->siapeMatricula)?'NULL':$this->siapeMatricula).",siapeMatricula), nome = COALESCE(" . (is_null($this->nome) ? 'NULL' : "'".$this->nome."'") . ",nome), email = COALESCE(".(is_null($this->email)?'NULL':"'".$this->email."'").",email), senha = COALESCE(". (is_null($this->senha)?'NULL':"'".$this->senha."'") .",senha), status = COALESCE(".(is_null($this->status)?'NULL':$this->status).",status), TipoUsuario_id = COALESCE(".(is_null($this->tipoUsuario_id)?'NULL':$this->tipoUsuario_id).",TipoUsuario_id) WHERE id = $this->id";
        return $con->executa($sql) > 0;
    }
	
	public function atualizarDataUltimoAcesso($siapeMatricula) {
		$con = new MySQL();		
        $sql = "UPDATE Usuario SET dataUltimoAcesso = now() WHERE siapeMatricula = '$siapeMatricula'";
        return $con->executa($sql) > 0;
    }

    public function jsonSerialize() {
        return (object) get_object_vars($this);
    }

}
