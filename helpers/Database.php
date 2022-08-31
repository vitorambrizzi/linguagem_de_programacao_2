<?php

class Database {
    function connect () {
        $servername = "localhost";
        $dbname = "social_music";
        $username = "root";
        $password = "";

        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        } catch (PDOException $e) {
            $this->dbError($e);
        }
    }

    function dbError ($e) {
        $result['error']['message'] = 'Server error, please try again!';
        $result['error']['database'] = $e;
        $output = new Output();
        $output->response($result, 500);
    }
}

?>