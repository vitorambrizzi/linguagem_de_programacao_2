<?php

// Imports configuration file and autoloader
require 'config.php';
require HELPERS_FOLDER . 'autoloader.php';

// Gets the requested URL
$url = $_SERVER['REQUEST_URI'];

// Removes the base URL
$urlClean = str_replace(BASE_PATH, '', $url);
$urlArray = explode('/', $urlClean);

// Verifies if the URL is formatted correctly
if (isset($urlArray[0]) && $urlArray[0] != '' && 
    isset($urlArray[1]) && $urlArray[1] != ''
){
    $controller = $urlArray[0] . 'Controller';
    $action = str_replace('-', '', $urlArray[1]);

    // Verifies if the URL is pointing to existing classes and methods
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