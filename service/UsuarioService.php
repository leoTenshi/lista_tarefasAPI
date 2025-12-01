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
        //Exemplo do trycatch com redudância
        try {
            $usuario = $this->dao->buscarPorEmailSenha($email, $senha);

            if (!$usuario) {
                throw new Exception("Email ou senha inválidos", 401);
            }

            return $usuario;
        } catch (Exception $e) {
            throw new Exception($e->getMessage(), (int)$e->getCode());
        }
    }
}

