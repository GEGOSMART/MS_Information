<?php

use OpenApi\Annotations as OA;

// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
// include database and object files
include_once './database.php';
include_once './score.php';
  
// get database connection
$database = new Database();
$db = $database->getConnection();
  
// prepare score object
$score = new score($db);
  
// get ID of score to be edited
$data = json_decode(file_get_contents("php://input"));
  
// set ID property of score to be edited
$score->ID = $data->ID;
  
// set score property values
$score->ID_User = $data->ID_User;
$score->Score = $data->Score;
$score->DatePlayed = $data->DatePlayed;
$score->ID_Game = $data->ID_Game;
  
// update the score
if($score->update()){
  
    // set response code - 200 ok
    http_response_code(200);
  
    // tell the user
    echo json_encode(array("message" => "score was updated."));
}
  
// if unable to update the score, tell the user
else{
  
    // set response code - 503 service unavailable
    http_response_code(503);
  
    // tell the user
    echo json_encode(array("message" => "Unable to update score."));
}
?>