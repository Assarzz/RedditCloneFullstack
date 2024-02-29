<?php

$result= [];
session_start();

include('../../model/DbEgyTalk.php'); 
$db = new DbEgyTalk();

// we get all the user data except from uid, since.... we already have that.

if (isset($_GET["uid"])){

    $result = $db->getUserFromUid($_GET["uid"]);
    unset($result["uid"]);

}
      // http://localhost/api/getUserFromUid.php?uid=



header('Content-Type: application/json');
echo json_encode($result, JSON_UNESCAPED_UNICODE);
