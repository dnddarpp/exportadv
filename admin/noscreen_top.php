<?
require_once("include.php");
session_start();
if( !$_SESSION["mng_mid"] ){
	echo "timeout";
	exit();
}
?>
