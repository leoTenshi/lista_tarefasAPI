<?php

class Login
{
    public function __construct()
    {
    }

    public function autenticar($email, $senha)
    {
        $service = new UsuarioService();

        try {
            $usuario = $service->login($email, $senha);

            // converter objeto em array, se vier como stdClass
            if (is_object($usuario)) {
                $usuario = (array) $usuario;
            }

            $token = Auth::gerarToken($usuario);

            return ['token' => $token];
        } catch (Exception $e) {
            // sobe erro para ser tratado em Rotas
            throw new Exception($e->getMessage());
        }
    }
}
