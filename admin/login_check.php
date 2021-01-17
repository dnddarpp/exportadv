<?php
session_start();
session_destroy();
session_start();
require_once('include_no.php');
//
// require_once('recaptcha.inc.php');
//
// if( !check_recaptcha($_POST['g-recaptcha-response'], $_SERVER['REMOTE_ADDR']) ){
// 		echo "reCAPTCHA測試失敗";
// 		exit;
// }

$mid = $conn->real_escape_string( $_POST["mid"] );
$pw = $conn->real_escape_string( $_POST["pw"] );
$sql = "SELECT * FROM mng_user WHERE 1=1 and mid='$mid' AND pw='$pw'";
$result = qury_sel($sql, $conn);

if( mysqli_num_rows( $result ) == 1 ){
	$data = mysqli_fetch_assoc($result);
	if($data["status"]=="1"){
		$result = qury_sel($sql, $conn);
		$_SESSION["mng_id"] = $id;
		$_SESSION["mng_mid"] = $mid;
		$_SESSION["mng_name"] = $data["name"];
		$_SESSION["mng_type"] = $data["perm"];
		$_SESSION["mng_perm"] = $data["permlist"];
		echo "success";
	}else{
		echo "帳號停用中，請洽管理人員";
	}

} else {
	echo "帳號或密碼錯誤，請重試";
}
?>
