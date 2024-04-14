<?php
/*likepost.php */
error_reporting(E_ALL);
ini_set("display_errors", 1);
header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');
header('Access-Control-Allow-Method: GET');
header('Access-Control-Allow-Headers: Content-Type,Access-Control-Allow-Headers, Authorization, X-Request-With');

include('../functions/functions.php');

$input_data = json_decode(file_get_contents("php://input"));

$res;

if (empty($input_data)) {
    $res["msg"] = "No data received";
    echo json_encode($res);
    exit();
}
$likePost = likePost($input_data);

echo $likePost;
