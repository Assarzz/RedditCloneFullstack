<?php
session_start();
$result= [];

include('../../model/DbEgyTalk.php'); 
$db = new DbEgyTalk();

// get n number of the latest posts
// or get 

if (isset($_GET["pidStart"]) && isset($_GET["pidEnd"]) ){

    $pidStart = $_GET["pidStart"];
    $pidEnd = $_GET["pidEnd"];

    $result = $db->getPosts($pidStart, $pidEnd);

}

header('Content-Type: application/json');
echo json_encode($result, JSON_UNESCAPED_UNICODE);
