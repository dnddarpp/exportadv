<?
require_once("include_no.php");

$id = 0 + $conn->real_escape_string($_POST['id']);
$title = $conn->real_escape_string($_POST['title']);
$type = 0 + $conn->real_escape_string($_POST['type']);
$display = 0 + $conn->real_escape_string($_POST['display']);
$sort = 0 + $conn->real_escape_string($_POST['sort']);
$url =$conn->real_escape_string($_POST['url']);
$pic = $conn->real_escape_string($_POST['pic']);
$seo_title =$conn->real_escape_string($_POST['seo_title']);
$seo_desc =$conn->real_escape_string($_POST['seo_desc']);
$seo_keywords =$conn->real_escape_string($_POST['seo_keywords']);


$time_f = date('Y-m-d H:i:s');

/* 日期 */

	$sql = "SELECT COUNT(*) FROM `media` WHERE `id`='$id'";
	if( qury_one( $sql, $conn ) == "0" ){
		$data = array(
			'title'=>$title,
			'type'=>$type,
			'display'=>$display,
			'sort'=>$sort,
			'url'=>$url,
			'pic'=>$pic,
			'MetaTitle'=>$seo_title,
			'MetaDesc'=>$seo_desc,
			'MetaKeywords'=>$seo_keywords,
			'init_time'=>$time_f,
			'Last_time'=>$time_f,
		);
		insert_hash( 'media', $data, $conn );
	} else {
		$data = array(
			'title'=>$title,
			'type'=>$type,
			'display'=>$display,
			'sort'=>$sort,
			'url'=>$url,
			'pic'=>$pic,
			'MetaTitle'=>$seo_title,
			'MetaDesc'=>$seo_desc,
			'MetaKeywords'=>$seo_keywords,
			'Last_time'=>$time_f,
		);
		update_hash( 'media', "`id`='$id'", $data, $conn );
	}
	$now_status["status"] = 'success';
	echo json_encode($now_status);

?>
