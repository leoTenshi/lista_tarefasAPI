<?php
class Rotas {
    private $endpoints = [];

    public function __construct(){
        $this->endpoints = [
            "tarefa" => new Acao([
                Acao::GET    => new Endpoint("Tarefa", "listar"),
                Acao::POST   => new Endpoint("Tarefa", "inserir"),
                Acao::PATCH  => new Endpoint("Tarefa", "alterarStatus"),
                Acao::DELETE => new Endpoint("Tarefa", "excluir")
            ]),

            "categoria" => new Acao([
                Acao::GET    => new Endpoint("Categoria", "listar"),
                Acao::POST   => new Endpoint("Categoria", "inserir"),
                Acao::DELETE => new Endpoint("Categoria", "excluir")
            ]),

            "login" => new Acao([
                Acao::POST => new Endpoint("Login", "autenticar")
            ])
        ];
    }

    public function executar($rota) {
        if (isset($this->endpoints[$rota])) {
            $endpoint = $this->endpoints[$rota];

            $retorno = new Retorno();

            try {
                $dados = $endpoint->executar();
                $retorno->dados = $dados;
                $retorno->erro  = null;
                $retorno->codigo_http = 200;
            } catch (Exception $e) {
                $retorno->dados = null;
                $codigo = $e->getCode();
                // erro HTTP conhecido (400 a 499).
                if (is_int($codigo) && $codigo >= 400 && $codigo < 500) {
                    $retorno->erro = $e->getMessage(); // Mensagem segura 
                    $retorno->codigo_http = $codigo;
                } else {
                    // Erro Técnico (SQL, Variável Indefinida, Conexão, etc)
                    $retorno->erro = "Ocorreu um erro interno no servidor."; 
                    $retorno->codigo_http = 500;
                }
            }

            return $retorno;
        }

        return null;
    }
}
