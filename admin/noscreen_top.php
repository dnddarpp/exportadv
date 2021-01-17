<?
require_once("include.php");
session_start();
if( !$_SESSION["mid"] ){
	echo "timeout";
	exit();
}
?>