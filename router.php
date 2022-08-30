<?php

// Importa o arquivo de configuração
require 'config.php';
require HELPERS_FOLDER . 'autoloader.php';

// Pega a url requisitada
$url = $_SERVER['REQUEST_URI'];

// Remove a base da Url
$urlClean = str_replace(BASE_PATH, '', $url);
$urlArray = explode('/', $urlClean);

// Verifica se a url está no formato correto
if (isset($urlArray[0]) && $urlArray[0] != '' && 
    isset($urlArray[1]) && $urlArray[1] != ''
){
    $controller = $urlArray[0] . 'Controller';
    $action = str_replace('-', '', $urlArray[1]);

    // Verifica se a url indica classes e métodos existentes
    if (file_exists(CONTROLLERS_FOLDER . $controller . '.php')) {
        $obj = new $controller();
        if (method_exists($obj, $action)) {
            $obj->$action();
            die;
        }
    }
}

$output = new Output();
$output->notFound();

?>