<?php
include "generic/Autoload.php";

interface ITarefaDAO {
    public function listar();
    public function inserir(array $tarefa);
    public function atualizarStatus($id, $novoStatus);
    public function excluir($id);
}
