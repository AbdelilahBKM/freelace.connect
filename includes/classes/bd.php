<?php
class Connection{
private $servername = "localhost";
private $username = "root";
private $password = "";
private $db_name = "freelancedb";
public $conn;
public function __construct(){
    // Create connection
    //code
    $this->conn = mysqli_connect($this->servername, $this->username, $this->password, $this->db_name);
    // Check connection
    //code
    if($this->conn->connect_error){
        die("Connection failed: " . $this->conn->connect_error);
    
    }
}
}
?>
