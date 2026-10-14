<?php 
session_start();
$response = [];
$_SESSION = array();
if(empty($_SESSION))
{
    $response = ['status' => 'success'];
}
else
{
    $response = ['status' => 'error'];
}
header('Content-Type: application/json');
echo json_encode($response);
?>