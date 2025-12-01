<?php 
class Endpoint {
    public $classe;
    public $execucao;

    public function __construct($classe, $execucao) {
        $this->classe = $classe;
        $this->execucao = $execucao;
    }
}
