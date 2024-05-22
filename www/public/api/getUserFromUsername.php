<?php

$result= [];
session_start();

include('../../model/DbEgyTalk.php'); 
$db = new DbEgyTalk();


if (isset($_GET["username"]))
{
    $result = $db->getUserFromUsername($_GET["username"]);

}
      // http://localhost/api/getUserFromUsername.php?username=



header('Content-Type: application/json');
echo json_encode($result, JSON_UNESCAPED_UNICODE);
