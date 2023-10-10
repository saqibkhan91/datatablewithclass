<?php
class Database
{

private $servername = "localhost";
private $database = "ajaxcrud";
private $username = "root";
private $password = "Arshad_123";
 protected $conn;
 
// Create connection

public function __construct(){


 try {
    $conn = new PDO($this->servername, $this->username, $this->password, $this->database);
 } catch (PDOException $e) {
    echo "Connection Error.". $e->getMassage();
 }
}
    
}
 
?>
