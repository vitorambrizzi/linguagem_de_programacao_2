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
        $conn = Database::connect();

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
            Database::dbError($e);
        }
    }

    function list() {
        $conn = Database::connect();

        try {
            // Creating the SQL statement
            $stmt = $conn->prepare("SELECT id, name, email, avatar FROM users");

            // Executing the SQL statement
            $stmt->execute();

            // Fetching the resulting rows and ending the connection
            $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $conn = null;

            return $users;
        } catch (PDOException $e) {
            Database::dbError($e);
        }
    }

    function getById() {
        $conn = Database::connect();

        try {
            // Creating the SQL statement
            $stmt = $conn->prepare("SELECT id, name, email, avatar FROM users WHERE id = :id");

            // Binding parameters
            $stmt->bindParam(':id', $this->id);

            // Executing the SQL statement
            $stmt->execute();

            // Fetching the resulting rows and ending the connection
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            $conn = null;

            return $user;
        } catch (PDOException $e) {
            Database::dbError($e);
        }
    }

    function delete() {
        $conn = Database::connect();

        try {
            // Creating the SQL statement
            $stmt = $conn->prepare("DELETE FROM users WHERE id = :id");

            // Binding parameters
            $stmt->bindParam(':id', $this->id);

            // Executing the SQL statement
            $stmt->execute();

            // Counting the resulting rows and ending the connection
            $rowsAffected = $stmt->rowCount();
            $conn = null;
            if ($rowsAffected) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            Database::dbError($e);
        }
    }
}

?>