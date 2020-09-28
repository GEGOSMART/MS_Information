<?php
class score{
 

 
    // database connection and table ID_User
    private $conn;
    private $table_ID_User = "score";
  
    // object properties
    public $ID;
    public $ID_User;
    public $Score;
    public $DatePlayed;
    public $ID_Game;
  
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    public function read(){
  
    // select all query
    $query = "SELECT
                *
            FROM
                " . $this->table_ID_User ." " ;
  
    // prepare query statement
    $stmt = $this->conn->prepare($query);
  
    // execute query
    $stmt->execute();
  
    return $stmt;
    }
    // create product
    function create(){
  
    // query to insert record
    $query = "INSERT INTO
                " . $this->table_ID_User . "
            SET
                ID_User=:ID_User, Score=:Score, DatePlayed=:DatePlayed, ID_Game=:ID_Game";
  
    // prepare query
    $stmt = $this->conn->prepare($query);
  
    // sanitize
    $this->ID_User=htmlspecialchars(strip_tags($this->ID_User));
    $this->Score=htmlspecialchars(strip_tags($this->Score));
    $this->DatePlayed=htmlspecialchars(strip_tags($this->DatePlayed));
    $this->ID_Game=htmlspecialchars(strip_tags($this->ID_Game));
  
    // bind values
    $stmt->bindParam(":ID_User", $this->ID_User);
    $stmt->bindParam(":Score", $this->Score);
    $stmt->bindParam(":DatePlayed", $this->DatePlayed);
    $stmt->bindParam(":ID_Game", $this->ID_Game);
  
    // execute query
    if($stmt->execute()){
        return true;
    }
  
    return false;
      
}

// update the product
function update(){
  
    // update query
    $query = "UPDATE
                " . $this->table_ID_User . "
            SET
                ID_User = :ID_User,
                Score = :Score,
                DatePlayed = :DatePlayed,
                ID_Game = :ID_Game
            WHERE
                ID = :ID";
  
    // prepare query statement
    $stmt = $this->conn->prepare($query);
  
    // sanitize
    $this->ID_User=htmlspecialchars(strip_tags($this->ID_User));
    $this->Score=htmlspecialchars(strip_tags($this->Score));
    $this->DatePlayed=htmlspecialchars(strip_tags($this->DatePlayed));
    $this->ID_Game=htmlspecialchars(strip_tags($this->ID_Game));
    $this->ID=htmlspecialchars(strip_tags($this->ID));
  
    // bind new values
    $stmt->bindParam(':ID_User', $this->ID_User);
    $stmt->bindParam(':Score', $this->Score);
    $stmt->bindParam(':DatePlayed', $this->DatePlayed);
    $stmt->bindParam(':ID_Game', $this->ID_Game);
    $stmt->bindParam(':ID', $this->ID);
  
    // execute the query
    if($stmt->execute()){
        return true;
    }
  
    return false;
}

// delete the product
function delete(){
  
    // delete query
    $query = "DELETE FROM " . $this->table_ID_User . " WHERE ID = ?";
  
    // prepare query
    $stmt = $this->conn->prepare($query);
  
    // sanitize
    $this->ID=htmlspecialchars(strip_tags($this->ID));
  
    // bind id of record to delete
    $stmt->bindParam(1, $this->ID);
  
    // execute query
    if($stmt->execute()){
        return true;
    }
  
    return false;
}

function getbestscorebyuser(){
  
    // delete query
    $query = "SELECT * FROM " . $this->table_ID_User . " WHERE ID_User = :ID_User AND ID_Game = :ID_Game ORDER BY Score DESC";
  
    // prepare query
    $stmt = $this->conn->prepare($query);
  
    $this->ID_User=htmlspecialchars(strip_tags($this->ID_User));
    $this->ID_Game=htmlspecialchars(strip_tags($this->ID_Game));

    $stmt->bindParam(':ID_User', $this->ID_User);
    $stmt->bindParam(':ID_Game', $this->ID_Game);
    
    // execute query
    $stmt->execute();

    return $stmt;
}

function getrecordsofgame(){
  
    // delete query
    $query = "SELECT * FROM " . $this->table_ID_User . "WHERE ID_Game = :ID_Game ORDER BY Score DESC";
  
    // prepare query
    $stmt = $this->conn->prepare($query);

    $this->ID_Game=htmlspecialchars(strip_tags($this->ID_Game));


    $stmt->bindParam(':ID_Game', $this->ID_Game);
  
  
    // execute query
    $stmt->execute();
    return $stmt;

}

}
?>