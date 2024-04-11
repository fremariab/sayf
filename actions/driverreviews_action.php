<?php
/*driverreviews_action.php */
error_reporting(E_ALL);
ini_set("display_errors", 1);
header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');
header('Access-Control-Allow-Method: GET');
header('Access-Control-Allow-Headers: Content-Type,Access-Control-Allow-Headers, Authorization, X-Request-With');

include('../functions/functions.php');

$inputData = json_decode(file_get_contents("php://input"));

$res;

if (empty($inputData)) {
    $res["msg"] = "No data received";
    echo json_encode($res);
    exit();
}
$getDriverReviews = getDriverReviews($inputData);

echo $getDriverReviews;
