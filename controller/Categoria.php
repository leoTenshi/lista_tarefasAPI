<?php 
class Categoria {

    public function __construct() {
    }
    
    public function listar() {
        Auth::validarToken(); 
        $service = new CategoriaService();
        $resultado = $service->listar();
        return $resultado;
    }

    public function inserir($nome) {
        Auth::validarToken(); 
        $service = new CategoriaService();
        $resultado = $service->inserir(['nome' => $nome]);
        return "Categoria criada!";
    }

    public function excluir($id) {
        Auth::validarToken(); 
        $service = new CategoriaService();
        $resultado = $service->excluir($id);
        return "Categoria excluída!";
    }
}
