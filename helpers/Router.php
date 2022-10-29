<?php
class Router {
    static function gateKeeper() {
        self::handleCORS();

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
            $removeParams = explode('?', $urlArray[1]);
            $action = str_replace('-', '', $removeParams[0]);

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

    static function allowedMethod($method) {
        if ($_SERVER['REQUEST_METHOD'] !== $method) {
            $result['error']['message'] = 'Method ' . $_SERVER['REQUEST_METHOD'] . ' not allowed for this route!';
            Output::response($result, 405);
        }
    }

    static function protected() {
        if (isset($_SERVER['HTTP_AUTHORIZATION'])) {
            $authorization = $_SERVER['HTTP_AUTHORIZATION'];
        } else {
            $authorization = 'Not set';
        }
        $result['auth']['message'] = $authorization;
        Output::response($result);
    }

    static function handleCORS() {
        if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
            header('Access-Control-Allow-Origin: ' . ALLOWED_HOSTS);
            header('Access-Control-Allow-Methods: ' . ALLOWED_METHODS);
            die;
        }
    }
}
?>