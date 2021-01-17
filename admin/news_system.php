<?
require_once("noscreen_top.php");

$id = 0 + $conn->real_escape_string($_POST['id']);
$title = $conn->real_escape_string($_POST['title']);
$description =$conn->real_escape_string($_POST['description']);
$date =$conn->real_escape_string($_POST['date']);
$pic = $conn->real_escape_string($_POST['pic']);
$display = 0 + $conn->real_escape_string($_POST['display']);
$sort = 0 + $conn->real_escape_string($_POST['sort']);
$content =$_POST['cnt'];
$url =$_POST['url'];
$type =$_POST['type'];
$seo_title =$_POST['seo_title'];
$seo_desc =$_POST['seo_desc'];
$seo_keywords =$_POST['seo_keywords'];

$time_f = date('Y-m-d H:i:s');

//echo "id:".$id;


/* 日期 */

	$sql = "SELECT COUNT(*) FROM `news` WHERE `id`='$id'";
	if( qury_one( $sql, $conn ) == "0" ){
		$data = array(
			'title'=>$title,
			'description'=>$description,
			'Public_date'=>$date,
			'type'=>$type,
			'display'=>$display,
			'sort'=>$sort,
			'url'=>$url,
			'pic'=>$pic,
			'content'=>$content,
			'MetaTitle'=>$seo_title,
			'MetaDesc'=>$seo_desc,
			'MetaKeywords'=>$seo_keywords,
			'init_time'=>$time_f,
			'Last_time'=>$time_f,
		);
		insert_hash( 'news', $data, $conn );
	} else {
		$data = array(
			'title'=>$title,
			'description'=>$description,
			'Public_date'=>$date,
			'type'=>$type,
			'display'=>$display,
			'sort'=>$sort,
			'url'=>$url,
			'pic'=>$pic,
			'content'=>$content,
			'MetaTitle'=>$seo_title,
			'MetaDesc'=>$seo_desc,
			'MetaKeywords'=>$seo_keywords,
			'Last_time'=>$time_f,
		);
		update_hash( 'news', "`id`='$id'", $data, $conn );
	}
	$now_status["status"] = 'success';
	echo json_encode($now_status);

?>
