<?php


class Database{
  
    // specify your own database credentials
    private $host = "msinformation.cpxn66rywhwf.us-east-1.rds.amazonaws.com";
    private $db_name = "MS_Information";
    private $username = "root";
    private $password = "germania";
    public $conn;
  
    // get the database connection
    public function getConnection(){
  
  
        try{
            $this->conn = new mysqli('msinformation.cpxn66rywhwf.us-east-1.rds.amazonaws.com', 'root', 'germania', 'MS_Information');
            $this->conn->exec("set names utf8");
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }
  
        return $this->conn;
    }
}
?>