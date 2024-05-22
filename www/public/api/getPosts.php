<?php

$result= [];
session_start();

include('../../model/DbEgyTalk.php'); 
$db = new DbEgyTalk();


if (isset($_GET["pidStart"]) && isset($_GET["count"]) ){

    $pidStart = $_GET["pidStart"];
    $count = $_GET["count"];

    $result = $db->getPosts($pidStart, $count);

}
      // http://localhost/api/getPosts.php?pidStart=0&pidEnd=20


header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

header('Content-Type: application/json');
echo json_encode($result, JSON_UNESCAPED_UNICODE);
