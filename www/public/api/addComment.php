<?php
/**
 * Lägger till en kommentar
 * 
 * @param $_POST['pid']  pid för post som skall kommenteras
 * @param $_POST['comment_txt']  pid för post som skall kommenteras
 * @return {"success": true/false} beroende på om det gick att lägga till en post
 */
session_start();

include('../../model/DbEgyTalk.php');
$db = new DbEgyTalk();

// check if isset for all the $uid, $pid, $comment_txt, $pcid post arguments

$success = "";
if (isset($_POST["uid"]) && isset($_POST["pid"]) && isset($_POST["comment_txt"])){
    $uid = $_POST["uid"];
    $pid = $_POST["pid"];
    $comment_txt = $_POST["comment_txt"];
    $pcid = null;
    if (isset($_POST["pcid"])){
        $pcid = $_POST["pcid"];
    }

    $success = $db->addComment($uid, $pid, $comment_txt, $pcid);
}

// Kod!

$result['success'] =  $success;

header('Content-Type: application/json');
echo json_encode($result, JSON_UNESCAPED_UNICODE);


