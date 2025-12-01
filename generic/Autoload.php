<?php
spl_autoload_register(function($class){
    $dirs = ['controller', 'dao', 'generic', 'service'];

    foreach ($dirs as $dir) {
        $caminho = __DIR__ . "/../{$dir}/{$class}.php";
        if (file_exists($caminho)) {
            include $caminho;
            return;
        }
    }
});
