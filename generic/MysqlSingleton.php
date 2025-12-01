<?php 
class MysqlSingleton {
    private static $instance;
    private $conexao;

    private function __construct()
    {
        if ($this->conexao == null) {
            $this->conexao = new PDO("mysql:host=localhost;dbname=lista_tarefas", "root", "");
            $this->conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
    }

    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new MysqlSingleton(); 
        }

        return self::$instance;
    }

    public function executar($query, $param = array()) {
        if ($this->conexao) {
            $sth = $this->conexao->prepare($query);
            foreach ($param as $k => $v) {
                $sth->bindValue($k, $v);
            }

            $sth->execute();

            // SELECT - retorna dados como objetos
            if (stripos(trim($query), 'select') === 0) {
                return $sth->fetchAll(PDO::FETCH_OBJ);
            }

            // INSERT/UPDATE/DELETE - só true/false
            return $sth->rowCount() > 0;
        }

        return false;
    }
}
