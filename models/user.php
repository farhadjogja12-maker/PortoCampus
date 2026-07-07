<?php

class User {

    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function login($email,$password)
    {
        $sql = "SELECT * FROM users
                WHERE email='$email'
                AND password='$password'";

        return $this->conn->query($sql);
    }

}