<?php


// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
// include database and object file
include_once './database.php';
include_once './score.php';
  
// get database connection
$database = new Database();
$db = $database->getConnection();
  
// prepare product object
$score = new score($db);
  
// get product id
$data = json_decode(file_get_contents("php://input"));
  
// set product id to be deleted
$score->ID = $data->ID;

/**
   * @OA\Post(
   *     path="/delete.php",
   *     summary="",
   *     description="delete an object  table score"
   *     @OA\RequestBody(
   *         description="Client side search object",
   *         required=true,
   *         @OA\MediaType(
   *             mediaType="application/json",                 
   *         @OA\Schema(ref="#/components/schemas/SearchObject")
   *         )
   *     ),
   *     @OA\Response(
   *         response=200
   *         description="Success",
   *     @OA\Schema(ref="#/components/schemas/SearchResultObject)   
   *     ), 
   *     @OA\Response(
   *         response=503,
   *         description="Unable to create score."
   *     )   
   * )
   */
  
// delete the product
if($score->delete()){
  
    // set response code - 200 ok
    http_response_code(200);
  
    // tell the user
    echo json_encode(array("message" => "Score was deleted."));
}
  
// if unable to delete the product
else{
  
    // set response code - 503 service unavailable
    http_response_code(503);
  
    // tell the user
    echo json_encode(array("message" => "Unable to delete score."));
}
?>