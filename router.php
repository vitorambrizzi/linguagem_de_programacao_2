<?php

// Importa o arquivo de configuração
require('config.php');

// Pega a url requisitada
$url = $_SERVER['REQUEST_URI'];

// Remove a base da Url
$urlClean = str_replace(BASE_PATH, '', $url);
$urlArray = explode('/', $urlClean);

if (isset($urlArray[0]) && $urlArray[0] != '' && 
    isset($urlArray[1]) && $urlArray[1] != ''
){
    $controller = $urlArray[0];
    $action = $urlArray[1];
}
else {
    echo 'Endereço da API inválido!';
    die;
}

echo 'Controller: ' . $controller . '<br />';
echo 'Action: ' . $action . '<br />';

?>