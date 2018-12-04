<?php

class Connection {
    private $conn;

    public function __construct() {
        $this->conn = mysqli_connect('localhost', 'root', '', 'chatphp');
        if (mysqli_connect_errno())
            die("Failed to connect to MySQL: " . mysqli_connect_error());
    }

    public function getConnection() {
        return $this->conn;
    }
}

?>