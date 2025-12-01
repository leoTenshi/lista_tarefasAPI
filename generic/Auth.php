<?php

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class Auth
{
    private static string $chave_secreta = 'chavemuitosecreta';

    // gera token para um usuário
    public static function gerarToken(array $usuario): string
    {
        $payload = [
            'iss'     => 'localhost',           // emissor
            'aud'     => 'localhost',           // destinatário
            'iat'     => time(),                // emitido em
            'exp'     => time() + 3600,         // expira em 1h
            'user_id' => $usuario['id']         // dado do usuário
        ];

        return JWT::encode($payload, self::$chave_secreta, 'HS256');
    }

    
    public static function validarToken()
    {
        $headers = getallheaders();

        if (!isset($headers['Authorization'])) {
            throw new Exception('Acesso não autorizado! Token ausente.', 401);
        }

        $token = str_replace('Bearer ', '', $headers['Authorization']);

        try {
            $decodificado = JWT::decode($token, new Key(self::$chave_secreta, 'HS256'));
            return $decodificado;
        } catch (Exception $e) {
            throw new Exception('Acesso não autorizado! Token inválido.', 401);
        }
    }
}
