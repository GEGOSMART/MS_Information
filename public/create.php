<?php

use OpenApi\Annotations as OA;


// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
// get database connection
include_once './database.php';
  
// instantiate score object
include_once './score.php';
  
$database = new Database();
$db = $database->getConnection();
  
$score = new score($db);
  
// get posted data
$data = json_decode(file_get_contents("php://input"));
  

/**
   * @OA\Post(
   *     path="/create.php",
   *     summary="",
   *     description="create an object for table score"
   *     @OA\RequestBody(
   *         description="Client side search object",
   *         required=true,
   *         @OA\MediaType(
   *             mediaType="application/json",                 
   *         @OA\Schema(ref="#/components/schemas/SearchObject")
   *         )
   *     ),
   *     @OA\Response(
   *         response=201,
   *         description="Success",
   *     @OA\Schema(ref="#/components/schemas/SearchResultObject)   
   *     ), 
   *     @OA\Response(
   *         response=404,
   *         description="Could Not Find Resource"
   *     ) , 
   *     @OA\Response(
   *         response=503,
   *         description="Unable to create score."
   *     )   
   * )
   */

// make sure data is not empty
if(
    !empty($data->ID_User) &&
    !empty($data->Score) &&
    !empty($data->DatePlayed) &&
    !empty($data->ID_Game) 
){
  
    // set score property values
    $score->ID_User = $data->ID_User;
    $score->Score = $data->Score;
    $score->DatePlayed = $data->DatePlayed;
    $score->ID_Game = $data->ID_Game;
  
    // create the score
    if($score->create()){
  
        // set response code - 201 created
        http_response_code(201);
  
        // tell the user
        echo json_encode(array("message" => "score was created."));
    }
  
    // if unable to create the score, tell the user
    else{
  
        // set response code - 503 service unavailable
        http_response_code(503);
  
        // tell the user
        echo json_encode(array("message" => "Unable to create score."));
    }
}
  
// tell the user data is incomplete
else{
  
    // set response code - 400 bad request
    http_response_code(400);
  
    // tell the user
    echo json_encode(array("message" => "Unable to create score. Data is incomplete."));
}
?>