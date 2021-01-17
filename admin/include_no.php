<?php
session_start();
require_once("fun/conn.php");
require_once("fun/function.php");
require_once("fun/magic_quotes.php");
openDB();
date_default_timezone_set("Asia/Taipei");

/*$sql = "SELECT `perm` FROM mng_user WHERE `mid`='{$_SESSION['mid']}'";
$perm_o = qury_one( $sql, $conn );
$perm = json_decode( $perm_o, true );*/
?>
