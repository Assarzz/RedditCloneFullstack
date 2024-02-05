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

for ($i=0; $i < count($result); $i++) { 
        
    $result[$i]["user"] = $db->getUserFromUid($result[$i]["uid"]);
}


header('Content-Type: application/json');
echo json_encode($result, JSON_UNESCAPED_UNICODE);
