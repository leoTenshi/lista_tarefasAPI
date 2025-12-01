<?php
class Controller {
    private $rotas = null;

    public function __construct() {
        $this->rotas = new Rotas();
    }

    public function verificarChamadas($rota) {
        $retorno = $this->rotas->executar($rota);
        $method = $_SERVER["REQUEST_METHOD"] ?? 'GET';

        if ($retorno === null) {
            http_response_code(404);
        
            echo json_encode([
                'status' => false,
                'erro'   => "A rota '$rota' não foi encontrada.",
                'dados'  => null
            ], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
            
            return; 
        }

        //DEFINE O STATUS CODE BASEADO NO RETORNO
        if ($retorno->codigo_http) {
            http_response_code($retorno->codigo_http);
        } else {
             // Fallback caso algo escape
            http_response_code(200);
        }
        
        //se não houver erros define os códigos
        if (!$retorno->erro && $retorno->codigo_http >= 200 && $retorno->codigo_http < 300) {
            if ($method === 'POST') {
                http_response_code(201); 
            } elseif ($method === 'DELETE' || $method === 'PATCH') {
                http_response_code(200);
            }
        }

        header("Content-Type: application/json; charset=utf-8");

        $saida = [
            'status' => $retorno->erro ? false : true,
            'erro'   => $retorno->erro, // Aqui já vem mascarado se for erro técnico
            'retorno'=> $retorno->dados
        ];

        echo json_encode($saida, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    }
}



