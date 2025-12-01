<?php 
require __DIR__ . '/vendor/autoload.php'; // composer (JWT)

include "generic/autoload.php";

if (isset($_GET['param'])) {
    $controller = new Controller();
    $controller->verificarChamadas($_GET['param']);
} else {
    header("Content-Type: application/json; charset=utf-8");
    echo json_encode([
        'erro'  => 'Nenhuma rota informada',
        'dados' => null
    ], JSON_UNESCAPED_UNICODE);
}
