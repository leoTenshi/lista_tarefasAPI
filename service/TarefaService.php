<?php

class TarefaService {

    private TarefaDAO $dao;

    public function __construct()
    {
        $this->dao = new TarefaDAO();
    }

    public function listar()
    {
        try {
            return $this->dao->listar();
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function inserir(array $dados)
    {
        try {
            $dados['status'] = 'pendente';
            $resultado = $this->dao->inserir($dados); 

            if (!$resultado) {
                throw new Exception("Falha ao inserir a tarefa. Verifique os dados fornecidos.", 400);
            }
            return $resultado; // Retorna o resultado da DAO 
        } catch (Exception $e) {
            throw new Exception($e->getMessage(), (int)$e->getCode());
        }
    }

    public function atualizarStatus($id, $status)
    {
        try {
            $resultado = $this->dao->atualizarStatus($id, $status);

            if (!$resultado) {
                // Se rowCount() for 0, lança exceção
                throw new Exception("Tarefa não encontrada.", 404);
            }

            return true;
        } catch (Exception $e) {
            throw new Exception($e->getMessage(), (int)$e->getCode());
        }
    }

    public function excluir($id)
    {
        try {
            $resultado = $this->dao->excluir($id);

            if (!$resultado) {
                // Se rowCount() for 0, lança exceção
                throw new Exception("Tarefa não encontrada.", 404);
            }
            return true;
        } catch (Exception $e) {
            throw new Exception($e->getMessage(), (int)$e->getCode());
        }
    }
}
