<?php
/*viewrhc_action.php */
error_reporting(E_ALL);
ini_set("display_errors", 1);
header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');
header('Access-Control-Allow-Method: GET');
header('Access-Control-Allow-Headers: Content-Type,Access-Control-Allow-Headers, Authorization, X-Request-With');

include('../functions/functions.php');

$viewDriverList = viewDriverList();

echo $viewDriverList;
