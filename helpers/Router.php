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

    static function allowedRole($role) {
        $headers = apache_request_headers();
        if (isset($headers['Authorization'])) {
            $authorization = $headers['Authorization'];
            $arrayAuth = explode(' ', $authorization);
            if (isset($arrayAuth[0]) && isset($arrayAuth[1])) {
                $idUser = $arrayAuth[0];
                $token = $arrayAuth[1];
                $session = new Session(null, $idUser, $token, null);
                $tokenIsValid = $session->verifyToken($role);
                if ($tokenIsValid) {
                    return $idUser;
                } else {
                    $result['error']['message'] = "Unauthorized!";
                    Output::response($result, 403);
                }
            }
        }
        $result['error']['message'] = "User id or token not found at Authorization header!";
        Output::response($result, 403);
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