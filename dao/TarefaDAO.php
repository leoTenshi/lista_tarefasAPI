<?php

class TarefaDAO extends MysqlFactory implements ITarefaDAO {

    public function listar()
    {
        try {
            $sql = "SELECT t.*, u.nome AS usuario_nome 
                    FROM tarefas t
                    INNER JOIN usuarios u ON t.usuario_id = u.id";
            return $this->banco->executar($sql);
        } catch (Exception $e) {
            throw new Exception("Erro ao listar tarefas");
        }
    }

    public function inserir(array $tarefa)
    {
        try {
            $sql = "INSERT INTO tarefas (titulo, descricao, status, usuario_id, categoria_id)
                    VALUES (:titulo, :descricao, :status, :usuario_id, :categoria_id)";

            $params = [
                ':titulo'       => $tarefa['titulo'],
                ':descricao'    => $tarefa['descricao'],
                ':status'       => $tarefa['status'],
                ':usuario_id'   => $tarefa['usuario_id'],
                ':categoria_id' => $tarefa['categoria_id']
            ];

            return $this->banco->executar($sql, $params);
        } catch (Exception $e) {
            throw new Exception("Erro ao inserir tarefa");
        }
    }

    public function atualizarStatus($id, $novoStatus)
    {
        try {
            $sql = "UPDATE tarefas SET status = :status WHERE id = :id";
            $params = [
                ':status' => $novoStatus,
                ':id'     => $id
            ];

            return $this->banco->executar($sql, $params);
        } catch (Exception $e) {
            throw new Exception("Erro ao atualizar status da tarefa");
        }
    }

    public function excluir($id)
    {
        try {
            $sql = "DELETE FROM tarefas WHERE id = :id";
            $params = [':id' => $id];

            return $this->banco->executar($sql, $params);
        } catch (Exception $e) {
            throw new Exception("Erro ao excluir tarefa");
        }
    }
}
