<?php
session_start();
$result= [];

// how to use: /api/getAllPostsFromUid.php?uid=1b5395a6-c41e-11ee-8934-0242ac150002

if (isset($_SESSION['uid'])){
   include('../../model/DbEgyTalk.php');
   $db = new DbEgyTalk();
   $result = $db->getAllPostsFromUid($_GET["uid"]);
}

header('Content-Type: application/json');
echo json_encode($result, JSON_UNESCAPED_UNICODE);