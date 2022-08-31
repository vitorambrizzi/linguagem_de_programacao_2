<?php

class User {
    private $id;
    private $name;
    private $email;
    private $pass;
    private $avatar;

    function __construct($id, $name, $email, $pass, $avatar) {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->pass = $pass;
        $this->avatar = $avatar;
    }

    function create() {
        $db = new Database();
        $conn = $db->connect();

        try {
            // Creating the SQL statement
            $stmt = $conn->prepare("INSERT INTO users (name, email, pass, avatar)
            VALUES (:name, :email, :pass, :avatar)");

            // Binding parameters
            $stmt->bindParam(':name', $this->name);
            $stmt->bindParam(':email', $this->email);
            $stmt->bindParam(':pass', $this->pass);
            $stmt->bindParam(':avatar', $this->avatar);
            
            // Executing the SQL statement
            $stmt->execute();

            // Getting the last ID inserted and ending the connection
            $id = $conn->lastInsertId();
            $conn = null;

            return $id;
        } catch (PDOException $e) {
            $db->dbError($e);
        }
    }
}

?>