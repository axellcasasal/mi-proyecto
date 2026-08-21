<?php

class Usuario {
    private $conn;
    private $table_name = "usuarios";

    public $id; 
    public $username;
    public $password;
    public $rol;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function login($username, $password) {
        
        $query = "SELECT id, username, password, rol FROM " . $this->table_name . " WHERE username = :username LIMIT 0,1";
        
        $stmt = $this->conn->prepare($query);
        $username = htmlspecialchars(strip_tags($username));
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($password === $row['password'] || password_verify($password, $row['password'])) {
                return $row;
            }
        }
        return false;
    }
}
?>