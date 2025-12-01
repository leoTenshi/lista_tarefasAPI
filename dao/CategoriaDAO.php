<?php
    include "generic/Autoload.php";

    class CategoriaDAO extends MysqlFactory implements ICategoriaDAO {

        public function listar()
        {
            $sql = "SELECT * FROM categorias";
            return $this->banco->executar($sql);
        }

        public function inserir(array $categoria)
        {
            $sql = "INSERT INTO categorias (nome) VALUES (:nome)";
            $params = [':nome' => $categoria['nome']];
            return $this->banco->executar($sql, $params);
        }

        public function excluir($id)
        {
            $sql = "DELETE FROM categorias WHERE id = :id";
            $params = [':id' => $id];
            return $this->banco->executar($sql, $params);
        }
    }
?>