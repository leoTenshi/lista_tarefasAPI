<?php

    class CategoriaService {

        private CategoriaDAO $dao;

        public function __construct()
        {
            $this->dao = new CategoriaDAO();
        }

        public function listar()
        {
            return $this->dao->listar();
        }

        public function inserir(array $dados)
        {
            return $this->dao->inserir($dados);
        }

        public function excluir($id)
        {
            return $this->dao->excluir($id);
        }
    }
?>