<?php
/**
 * Returnerar alla användare.
 * Viktigt att returnera uid, och namn
 */
include('../../model/DbEgyTalk.php'); 
$db = new DbEgyTalk();

session_start();
$result= $db->getAllUsers();

header('Content-Type: application/json');
echo json_encode($result, JSON_UNESCAPED_UNICODE);