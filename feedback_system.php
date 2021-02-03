<?php

require_once("include.php");

$id = 0 + $conn->real_escape_string($_POST['id']);
$trackid = $conn->real_escape_string($_POST['trackid']);
$feed = $conn->real_escape_string($_POST['feed']);

insertFeedback($id, $trackid,$feed, $conn);

$now_status["status"] = 'success';
echo json_encode($now_status);


 ?>
