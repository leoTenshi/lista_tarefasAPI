<?php

class Acao {
    const POST   = "POST";
    const GET    = "GET";
    const PUT    = "PUT";
    const PATCH  = "PATCH";
    const DELETE = "DELETE";    

    private $endpoint;

    public function __construct($endpoint = []){
        $this->endpoint = $endpoint;
    }

    public function executar(){

        $end = $this->endpointMetodo();

        if ($end) {
            $reflectMetodo = new ReflectionMethod($end->classe, $end->execucao);
            $parametros    = $reflectMetodo->getParameters();
            $returnParam   = $this->getParam();

            if ($parametros) {
                $para = [];

                foreach($parametros as $v) {
                    $name = $v->getName(); // nome do parâmetro do método

                    if (!array_key_exists($name, $returnParam)) {
                        if ($v->isDefaultValueAvailable()) {
                            $para[] = $v->getDefaultValue();
                        } else {
                            throw new Exception("Parâmetro(s) obrigatório(s) ausente(s) na requisição.", 400);
                        }
                    } else {
                        $para[] = $returnParam[$name];
                    }
                }

                return $reflectMetodo->invokeArgs(new $end->classe(), $para);
            }

            return $reflectMetodo->invoke(new $end->classe());
        }

        return null;
    }

    private function endpointMetodo(){
        $method = $_SERVER["REQUEST_METHOD"] ?? self::GET;
        return isset($this->endpoint[$method]) ? $this->endpoint[$method] : null;
    }

    private function getPost(){
        return $_POST ?: [];
    }

    private function getGet(){
        if($_GET) {
            $get = $_GET;
            unset($get["param"]);
            return $get;
        }
        return [];
    }

    private function getInput (){
        $input = file_get_contents("php://input");

        if ($input){
            $json = json_decode($input, true);
            if (is_array($json)) {
                return $json;
            }
        }
        return [];
    }

    public function getParam(){
        return array_merge($this->getPost(), $this->getGet(), $this->getInput());
    }
}
