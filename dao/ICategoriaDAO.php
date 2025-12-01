<?php
    include "generic/Autoload.php";

    interface ICategoriaDAO {
        public function listar();
        public function inserir(array $categoria);
        public function excluir($id);
    }
?>