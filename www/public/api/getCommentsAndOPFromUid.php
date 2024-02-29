<?php

include('../../model/DbEgyTalk.php'); 
$db = new DbEgyTalk();

session_start();
$result = [];
if (isset($_GET["uid"])){
    $result= $db->getCommentsAndOPFromUid($_GET["uid"]);
}

// http://localhost/api/getCommentAndOPFromUid.php?pid=4

/*
SELECT c.cid, c.comment_txt, c.uid, c.pcid, COALESCE(pc.cid, p.pid) AS parent_post_or_comment_id, COALESCE(pc.comment_txt, p.post_txt) AS parent_txt, COALESCE(pc.uid, p.uid) AS parent_uid FROM comment c INNER JOIN post p ON pc.cid IS null AND p.pid = c.pcid INNER JOIN comment pc ON pc.cid is NOT null AND c.pcid = pc.cid

SELECT
    c.cid,
    c.comment_txt,
    c.uid,
    c.pcid,
    p.pid AS ppid,
    COALESCE(pc.comment_txt, p.post_txt) AS parent_txt,
    COALESCE(pc.uid, p.uid) AS parent_uid
FROM
    comment c
LEFT JOIN
    comment pc ON c.pcid IS NOT NULL AND c.pcid = pc.cid
LEFT JOIN
    post p ON c.pcid IS NULL AND c.pid = p.pid;

*/

/*SELECT
    c.cid,
    c.comment_txt,
    c.uid,
    c.pcid,
    p.pid AS ppid,
    COALESCE(pc.comment_txt, p.post_txt) AS parent_txt,
    COALESCE(pc.uid, p.uid) AS parent_uid
FROM
    comment c
LEFT JOIN
    comment pc ON c.pcid IS NOT NULL AND c.pcid = pc.cid
LEFT JOIN
    post p ON c.pcid IS NULL AND c.pid = p.pid
WHERE c.uid = :uid; */


// http://localhost/api/getCommentsAndOPFromUid.php?uid=956eef04-c402-11ee-b2a4-0242ac150003

header('Content-Type: application/json');
echo json_encode($result, JSON_UNESCAPED_UNICODE);