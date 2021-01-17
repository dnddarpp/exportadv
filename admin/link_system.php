<?
require_once("include_no.php");

$id = 0 + $conn->real_escape_string($_POST['id']);
$title = $conn->real_escape_string($_POST['title']);
$display = 0 + $conn->real_escape_string($_POST['display']);
$sort = 0 + $conn->real_escape_string($_POST['sort']);
$url =$conn->real_escape_string($_POST['url']);


$time_f = date('Y-m-d H:i:s');

/* 日期 */

	$sql = "SELECT COUNT(*) FROM `link` WHERE `id`='$id'";
	if( qury_one( $sql, $conn ) == "0" ){
		$data = array(
			'title'=>$title,
			'display'=>$display,
			'sort'=>$sort,
			'url'=>$url,
			'init_time'=>$time_f,
			'Last_time'=>$time_f,
		);
		insert_hash( 'link', $data, $conn );
	} else {
		$data = array(
			'title'=>$title,
			'display'=>$display,
			'sort'=>$sort,
			'url'=>$url,
			'Last_time'=>$time_f,
		);
		update_hash( 'link', "`id`='$id'", $data, $conn );
	}
	$now_status["status"] = 'success';
	echo json_encode($now_status);

?>
