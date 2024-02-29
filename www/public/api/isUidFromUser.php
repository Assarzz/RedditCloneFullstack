<?php

$result['uidIsUser'] = false;
$result['status'] = "get or session variable is not set";
session_start();

include('../../model/DbEgyTalk.php'); 
$db = new DbEgyTalk();

// we get all the user data except from uid, since.... we already have that.

if (isset($_GET["uid"]) && isset($_SESSION['uid']))
{

    if($_SESSION["uid"] === $_GET["uid"]){

        $result['uidIsUser'] = true;
        $result['status'] = "success";

    }
    $result['status'] = "success";

}
      // http://localhost/api/getUserFromUid.php?uid=



header('Content-Type: application/json');
echo json_encode($result, JSON_UNESCAPED_UNICODE);
