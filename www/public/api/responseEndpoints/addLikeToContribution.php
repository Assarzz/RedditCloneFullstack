<?php


// input parameters post id/pid and comment id/cid

include('../../../model/DbEgyTalk.php');
$db = new DbEgyTalk();
session_start();

if (!isset($_GET["pid"])){
    $pid = null;
}
else{
    $pid = $_GET["pid"];
}

if (!isset($_GET["cid"])){
    $cid = null;
}
else{
    $cid = $_GET["cid"];
}




//                                               like/dislike   3       1
$result= $db->addLikeToContribution($uid, $pid, $cid);

header('Content-Type: application/json');
echo json_encode($result, JSON_UNESCAPED_UNICODE);