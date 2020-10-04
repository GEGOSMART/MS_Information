<?php

// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
  
// database connection will be here

// include database and object files
include_once './database.php';
include_once './score.php';
  
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
  
// initialize object
$score = new score($db);
  
// read products will be here

// query products
$stmt = $score->read();
$num = $stmt->rowCount();


// check if more than 0 record found
if($num>0){
  
    // products array
    $score_arr=array();
    $score_arr["scores"]=array();
  
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
  
        $score_item["score"]=array(
            "ID" => $ID,
            "ID_User" => $ID_User,
            "Score" => $Score,
    		"DatePlayed" =>$DatePlayed,
    		"ID_Game" => $ID_Game

        );
  
        array_push($score_arr["scores"], $score_item["score"]);
    }
  
    // set response code - 200 OK
    http_response_code(200);
  
    // show products data in json format
    echo json_encode($score_arr);
}else{
  
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user no products found
    echo json_encode(
        array("message" => "No scores found.")
    );
}

// read products
