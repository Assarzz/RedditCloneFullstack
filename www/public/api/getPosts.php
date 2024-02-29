<?php

$result= [];
session_start();

include('../../model/DbEgyTalk.php'); 
$db = new DbEgyTalk();


if (isset($_GET["pidStart"]) && isset($_GET["pidEnd"]) ){

    $pidStart = $_GET["pidStart"];
    $pidEnd = $_GET["pidEnd"];

    $result = $db->getPosts($pidStart, $pidEnd);

}
      // http://localhost/api/getPosts.php?pidStart=0&pidEnd=20



header('Content-Type: application/json');
echo json_encode($result, JSON_UNESCAPED_UNICODE);
