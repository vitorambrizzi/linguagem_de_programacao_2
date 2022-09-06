<?php

class Router {
    function gateKeeper() {
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
    }

    function allowedMethod($method) {
        if ($_SERVER['REQUEST_METHOD'] !== $method) {
            $result['error']['message'] = 'Method ' . $_SERVER['REQUEST_METHOD'] . ' not allowed for this route!';
            $output = new Output;
            $output->response($result, 405);
        }
    }
}

?>