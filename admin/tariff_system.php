<?
require_once("noscreen_top.php");

$id = 0 + $conn->real_escape_string($_POST['id']);
$title = $conn->real_escape_string($_POST['title']);
$description =$conn->real_escape_string($_POST['description']);
$display = 0 + $conn->real_escape_string($_POST['display']);
$sort = 0 + $conn->real_escape_string($_POST['sort']);
$pic = $conn->real_escape_string($_POST['pic']);
$type = 0 + $conn->real_escape_string($_POST['type']);

$url =$_POST['url'];


$time_f = date('Y-m-d H:i:s');

//echo "id:".$id;


/* 日期 */

	$sql = "SELECT COUNT(*) FROM `tariff` WHERE `id`='$id'";
	if( qury_one( $sql, $conn ) == "0" ){
		$data = array(
			'title'=>$title,
			'display'=>$display,
			'sort'=>$sort,
			'type'=>$type,
			'url'=>$url,
			'pic'=>$pic,
			'init_time'=>$time_f,
			'Last_time'=>$time_f,
		);
		insert_hash( 'tariff', $data, $conn );
	} else {
		$data = array(
			'title'=>$title,
			'display'=>$display,
			'sort'=>$sort,
			'type'=>$type,
			'url'=>$url,
			'pic'=>$pic,
			'Last_time'=>$time_f,
		);
		update_hash( 'tariff', "`id`='$id'", $data, $conn );
	}
	$now_status["status"] = 'success';
	echo json_encode($now_status);

?>
