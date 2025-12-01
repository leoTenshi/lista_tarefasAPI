<?php

class UsuarioService
{
    private UsuarioDAO $dao;

    public function __construct()
    {
        $this->dao = new UsuarioDAO();
    }

    public function login(string $email, string $senha)
    {
        try {
            $usuario = $this->dao->buscarPorEmailSenha($email, $senha);

            if (!$usuario) {
                throw new Exception("Usuário ou senha inválidos");
            }

            return $usuario;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
