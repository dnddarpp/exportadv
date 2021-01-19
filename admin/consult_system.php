<?
require_once("noscreen_top.php");

$id = 0 + $conn->real_escape_string($_POST['id']);
$title = $conn->real_escape_string($_POST['title']);
$description =$conn->real_escape_string($_POST['description']);
$parent =$conn->real_escape_string($_POST['parent']);
$display = 0 + $conn->real_escape_string($_POST['display']);
$endpage = 0 + $conn->real_escape_string($_POST['endpage']);
$sort = 0 + $conn->real_escape_string($_POST['sort']);
$content =$_POST['cnt'];
$url1 = $conn->real_escape_string($_POST['url1']);
$pic1 = $conn->real_escape_string($_POST['pic1']);
$url2 = $conn->real_escape_string($_POST['url2']);
$pic2 = $conn->real_escape_string($_POST['pic2']);
$url3 = $conn->real_escape_string($_POST['url3']);
$pic3 = $conn->real_escape_string($_POST['pic3']);
$url4 = $conn->real_escape_string($_POST['url4']);
$pic4 = $conn->real_escape_string($_POST['pic4']);
$url5 = $conn->real_escape_string($_POST['url5']);
$pic5 = $conn->real_escape_string($_POST['pic5']);

$seo_title = $conn->real_escape_string($_POST['seo_title']);
$seo_desc = $conn->real_escape_string($_POST['seo_desc']);
$seo_keywords = $conn->real_escape_string($_POST['seo_keywords']);

$time_f = date('Y-m-d H:i:s');

//echo "id:".$id;


/* 日期 */

	$sql = "SELECT COUNT(*) FROM `consult` WHERE `id`='$id'";
	if( qury_one( $sql, $conn ) == "0" ){
		$data = array(
			'title'=>$title,
			'description'=>$description,
			'parent'=>$parent,
			'display'=>$display,
			'endpage'=>$endpage,
			'sort'=>$sort,
			'url1'=>$url1,
			'url2'=>$url2,
			'url3'=>$url3,
			'url4'=>$url4,
			'url5'=>$url5,
			'pic1'=>$pic1,
			'pic2'=>$pic2,
			'pic3'=>$pic3,
			'pic4'=>$pic4,
			'pic5'=>$pic5,
			'content'=>$content,
			'MetaTitle'=>$seo_title,
			'MetaDesc'=>$seo_desc,
			'MetaKeywords'=>$seo_keywords,
			'init_time'=>$time_f,
			'Last_time'=>$time_f,
		);
		insert_hash( 'consult', $data, $conn );
	} else {
		$data = array(
			'title'=>$title,
			'description'=>$description,
			'parent'=>$parent,
			'display'=>$display,
			'endpage'=>$endpage,
			'sort'=>$sort,
			'url1'=>$url1,
			'url2'=>$url2,
			'url3'=>$url3,
			'url4'=>$url4,
			'url5'=>$url5,
			'pic1'=>$pic1,
			'pic2'=>$pic2,
			'pic3'=>$pic3,
			'pic4'=>$pic4,
			'pic5'=>$pic5,
			'content'=>$content,
			'MetaTitle'=>$seo_title,
			'MetaDesc'=>$seo_desc,
			'MetaKeywords'=>$seo_keywords,
			'init_time'=>$time_f,
			'Last_time'=>$time_f,
		);
		update_hash( 'consult', "`id`='$id'", $data, $conn );
	}
	$now_status["status"] = 'success';
	echo json_encode($now_status);

?>
