<?php

include_once $_SERVER['DOCUMENT_ROOT']."/modelo/Noticia.class.php";

class CategoriaNoticia
{
    private $id;
    private $descricao;
    private $cor;
        
    public function __construct($id = null, $descricao = null, $cor = null)
    {
        $this->id = $id;
        $this->descricao = $descricao;
        $this->cor = $cor;
    }
        
    public function getId()
    {
        return $this->id;
    }
        
    public function setId($id)
    {
        $this->id = $id;
    }
        
    public function getDescricao()
    {
        return $this->descricao;
    }
        
    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;
    }

    public function getCor()
    {
        return $this->cor;
    }
        
    public function setCor($cor)
    {
        $this->cor = $cor;
    }

    public function listarUm() {
        $con = new MySQL();
        $sql = "SELECT * FROM CategoriaNoticia WHERE id='$this->id'";
        $resultado = $con->consulta($sql);
        $categoria = new CategoriaNoticia();
        if (!empty($resultado)) {
            $categoria = new CategoriaNoticia();
            $categoria->setId($resultado[0]["id"]);
            $categoria->setDescricao($resultado[0]["descricao"]);
            $categoria->setCor($resultado[0]["cor"]);
			return $categoria;	
        } else {
            return false;
        }
    }

    public function listarTodos()
    {
        $con = new MySQL();
        $sql = "SELECT * FROM CategoriaNoticia";
        $resultados = $con->consulta($sql);
        if (!empty($resultados)) {
            $categorias = array();
            foreach ($resultados as $resultado) {
                $categoria = new CategoriaNoticia();
                $categoria->setId($resultado["id"]);
                $categoria->setDescricao($resultado["descricao"]);
				$categoria->setCor($resultado["cor"]);
				$categorias[] = $categoria;
            }
            return $categorias;
        } else {
            return false;
        }
    }
}
