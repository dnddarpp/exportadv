<?
require_once("noscreen_top.php");

$id = 0 + $conn->real_escape_string($_POST['id']);
$title = $conn->real_escape_string($_POST['title']);
$subtitle = $conn->real_escape_string($_POST['subtitle']);
$description =$conn->real_escape_string($_POST['description']);
// $date =$conn->real_escape_string($_POST['date']);
// $pic = $conn->real_escape_string($_POST['pic']);
// $display = 0 + $conn->real_escape_string($_POST['display']);
// $sort = 0 + $conn->real_escape_string($_POST['sort']);
$content =$_POST['cnt'];
// $url =$_POST['url'];
// $type =$_POST['type'];
$seo_title =$conn->real_escape_string($_POST['seo_title']);
$seo_desc =$conn->real_escape_string($_POST['seo_desc']);
$seo_keywords =$conn->real_escape_string($_POST['seo_keywords']);

$time_f = date('Y-m-d H:i:s');

//echo "id:".$id;


/* 日期 */

	$sql = "SELECT COUNT(*) FROM `page` WHERE `id`='$id'";
	if( qury_one( $sql, $conn ) == "0" ){
		$data = array(
			'title'=>$title,
			'subtitle'=>$subtitle,
			'description'=>$description,
			'content'=>$content,
			'MetaTitle'=>$seo_title,
			'MetaDesc'=>$seo_desc,
			'MetaKeywords'=>$seo_keywords,
			'Last_time'=>$time_f,
		);
		insert_hash( 'page', $data, $conn );
	} else {
		$data = array(
			'title'=>$title,
			'subtitle'=>$subtitle,
			'description'=>$description,
			'content'=>$content,
			'MetaTitle'=>$seo_title,
			'MetaDesc'=>$seo_desc,
			'MetaKeywords'=>$seo_keywords,
			'Last_time'=>$time_f,
		);
		update_hash( 'page', "`id`='$id'", $data, $conn );
	}
	$now_status["status"] = 'success';
	echo json_encode($now_status);

?>
