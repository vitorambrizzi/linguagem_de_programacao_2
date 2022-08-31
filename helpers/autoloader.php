<?php

function myLoader($class_name) {
    if (file_exists(CONTROLLERS_FOLDER . $class_name . '.php')) {
        require CONTROLLERS_FOLDER . $class_name . '.php';
    }
    if (file_exists(HELPERS_FOLDER . $class_name . '.php')) {
        require HELPERS_FOLDER . $class_name . '.php';
    }
    if (file_exists(MODELS_FOLDER . $class_name . '.php')) {
        require MODELS_FOLDER . $class_name . '.php';
    }
}

// Registra o myLoader para automatizar o carregamento das classes
spl_autoload_register('myLoader');

?>