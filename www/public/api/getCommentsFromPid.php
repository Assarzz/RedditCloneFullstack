<?php

include('../../model/DbEgyTalk.php'); 
$db = new DbEgyTalk();

session_start();
$result = [];
if (isset($_GET["pid"])){
    $result= $db->getCommentsFromPid($_GET["pid"]);
}

// http://localhost/api/getCommentsFromPid.php?pid=4

header('Content-Type: application/json');
echo json_encode($result, JSON_UNESCAPED_UNICODE);