<?
require_once("noscreen_top.php");

$id = 0 + $conn->real_escape_string($_POST['id']);
$title = $conn->real_escape_string($_POST['title']);
$description =$conn->real_escape_string($_POST['description']);
// $date =$conn->real_escape_string($_POST['date']);
$piclist = $_POST['pic'];
$display = 0 + $conn->real_escape_string($_POST['display']);
$sort = 0 + $conn->real_escape_string($_POST['sort']);
$cover = 0 + $conn->real_escape_string($_POST['cover']);
// $content =$_POST['cnt'];
// $url =$_POST['url'];
// $type =$_POST['type'];
$seo_title =$_POST['seo_title'];
$seo_desc =$_POST['seo_desc'];
$seo_keywords =$_POST['seo_keywords'];

$time_f = date('Y-m-d H:i:s');

//echo "id:".$id;


/* 日期 */

	$sql = "SELECT COUNT(*) FROM `event` WHERE `id`='$id'";
	if( qury_one( $sql, $conn ) == "0" ){
		$data = array(
			'title'=>$title,
			'description'=>$description,
			'display'=>$display,
			'sort'=>$sort,
			'cover'=>$cover,
			'pic'=>$piclist,
			'MetaTitle'=>$seo_title,
			'MetaDesc'=>$seo_desc,
			'MetaKeywords'=>$seo_keywords,
			'init_time'=>$time_f,
			'Last_time'=>$time_f,
		);
		insert_hash( 'event', $data, $conn );
	} else {
		$data = array(
			'title'=>$title,
			'description'=>$description,
			'display'=>$display,
			'sort'=>$sort,
			'cover'=>$cover,
			'pic'=>$piclist,
			'MetaTitle'=>$seo_title,
			'MetaDesc'=>$seo_desc,
			'MetaKeywords'=>$seo_keywords,
			'Last_time'=>$time_f,
		);
		update_hash( 'event', "`id`='$id'", $data, $conn );
	}
	$now_status["status"] = 'success';
	echo json_encode($now_status);

?>
