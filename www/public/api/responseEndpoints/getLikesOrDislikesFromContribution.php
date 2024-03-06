<?php


// input parameters post id/pid and comment id/cid

//http://localhost/api/responseEndpoints/getLikesOrDislikesFromContribution.php?likeOrDislike=%22like%22&pid=3
include('../../../model/DbEgyTalk.php');
$db = new DbEgyTalk();
session_start();

$likeOrDislike = $_GET["likeOrDislike"];

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
$result= $db->getLikesOrDislikesFromContribution($likeOrDislike, $pid, $cid);

header('Content-Type: application/json');
echo json_encode($result, JSON_UNESCAPED_UNICODE);