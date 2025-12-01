<?php 
class Tarefa {

    public function __construct() {
    }
    
    public function listar() {
        Auth::validarToken(); 
        $service = new TarefaService();
        $resultado = $service->listar();
        // Aqui é só retorno "puro"; quem transforma em JSON é o Controller genérico
        return $resultado;
    }

    
    public function inserir($titulo, $descricao = null, $usuario_id = null, $categoria_id = null) {
        Auth::validarToken(); 

        $service = new TarefaService();

        $dados = [
            'titulo'       => $titulo,
            'descricao'    => $descricao,
            'usuario_id'   => $usuario_id,
            'categoria_id' => $categoria_id
        ];

        $resultado = $service->inserir($dados);
        return ['mensagem' => 'Tarefa inserida com sucesso'];
    }

    public function alterarStatus($id, $status) {

        Auth::validarToken(); 
        $service = new TarefaService();
        $resultado = $service->atualizarStatus($id, $status);
        return ['mensagem' => 'Status alterado com sucesso'];
    }

    public function excluir($id) {

        Auth::validarToken(); 
        $service = new TarefaService();
        $resultado = $service->excluir($id);
        return ['mensagem' => 'Tarefa deletada com sucesso'];
    }
}
