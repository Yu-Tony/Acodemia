<?php
// used to get mysql database connection
class Database{
 
    // specify your own database credentials
    //https://stackoverflow.com/questions/28193713/change-port-of-mysql-server-in-phpmyadmin
    private $host = "127.0.0.1:3307";
    private $db_name = "acodemia_db";
    private $username = "root";
    private $password = "";
    public $conn;
 
    // get the database connection
    public function getConnection(){
 
        $this->conn = null;
 
        try
        {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            
        }catch(PDOException $exception)
        {
            echo "Connection error: " . $exception->getMessage();
        }
 
        return $this->conn;
    }
}
?>