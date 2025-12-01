<?php

class UsuarioDAO extends MysqlFactory
{
    public function buscarPorEmailSenha(string $email, string $senha)
    {
        try {
            $sql = "SELECT * FROM usuarios WHERE email = :email AND senha = :senha LIMIT 1";
            $params = [
                ':email' => $email,
                ':senha' => $senha 
            ];
            $res = $this->banco->executar($sql, $params);
            return $res[0] ?? null;
        } catch (Exception $e) {
            // não mostra erro técnico
            throw new Exception("Erro ao buscar usuário");
        }
    }
}
