<?php

class Output {
    function response($arrayResponse, $statusCode) {
        http_response_code($statusCode);
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($arrayResponse);
        die;
    }

    function notFound() {
        $result['message'] = "API endpoint not found!";
        $this->response($result, 404);
    }
}

?>