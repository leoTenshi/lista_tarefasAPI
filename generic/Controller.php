<?php
class Controller {
    private $rotas = null;

    public function __construct() {
        $this->rotas = new Rotas();
    }

    public function verificarChamadas($rota) {
        $retorno = $this->rotas->executar($rota);

        header("Content-Type: application/json; charset=utf-8");

        if($retorno) {
            $saida = [
                'erro'   => $retorno->erro,
                'retorno'   => $retorno->dados
            ];

            echo json_encode($saida, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        } else {
            $saida = [
                'status' => false,
                'erro'   => 'Rota não existe',
                'retorno'   => null
            ];

            echo json_encode($saida, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        }
    }
}

