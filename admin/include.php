<?php
session_start();
require_once("fun/conn.php");
require_once("fun/function.php");
require_once("fun/magic_quotes.php");
openDB();
date_default_timezone_set("Asia/Taipei");
/*if(!isset($_SESSION['mng_mid']) && empty($_SESSION['mng_mid'])) {
  echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('登入逾時，請重新登入')
    window.location.href='https://exportadv.com.tw/admin/ADLogin/login.aspx';
    </SCRIPT>");
}*/
/*$sql = "SELECT `status` FROM mng_user WHERE `mid`='{$_SESSION['mid']}'";
$data= qury_one( $sql, $conn );
if($data<=0){
  echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('帳號停用中，請洽管理人員')
    window.location.href='login.php';
    </SCRIPT>");
}*/
?>
<script type="text/javascript">
	var aaa = localStorage.getItem("ADaccount");
	if(!aaa){
		window.alert('登入逾時，請重新登入') 
		location.href='https://exportadv.com.tw/admin/ADLogin/login.aspx';
	}
</script>