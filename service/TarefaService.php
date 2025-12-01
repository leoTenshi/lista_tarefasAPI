<?php

class TarefaService {

    private TarefaDAO $dao;

    public function __construct() {
        $this->dao = new TarefaDAO();
    }

    public function listar() {
        return $this->dao->listar(); 
    }

    public function inserir(array $dados) {
        $dados['status'] = 'pendente';
        $resultado = $this->dao->inserir($dados); 

        if (!$resultado) {
            throw new Exception("Falha ao inserir a tarefa.", 400);
        }
        return $resultado;
    }

    public function atualizarStatus($id, $status) {
        $resultado = $this->dao->atualizarStatus($id, $status);

        if (!$resultado) {
            throw new Exception("Tarefa não encontrada.", 404);
        }
        return true;
    }

    public function excluir($id) {
        $resultado = $this->dao->excluir($id);

        if (!$resultado) {
            throw new Exception("Tarefa não encontrada.", 404);
        }
        return true;
    }
}