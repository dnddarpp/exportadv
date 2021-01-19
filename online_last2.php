<?php
	require_once("include.php");
	$id = $conn->real_escape_string($_GET["id"]);


	$layer = 0;
	if($id){
		$sql = "select *  from `consult` where 1=1 and id = $id ";
		$pjdata = qury_sel($sql, $conn);
		$data = mysqli_fetch_assoc($pjdata);
		$parent = $data["parent"];
		$text = $data["content"];

		if( ( $data['pic1'] != '') && file_exists( '../pic/consult/'.$data['pic1'] ) )
		$pic1 = "<img src='../pic/consult/".$data['pic1']."'>";

		if( ( $data['pic2'] != '') && file_exists( '../pic/consult/'.$data['pic2'] ) )
		$pic2 = "<img src='../pic/consult/".$data['pic2']."'>";

		if( ( $data['pic3'] != '') && file_exists( '../pic/consult/'.$data['pic3'] ) )
		$pic3 = "<img src='../pic/consult/".$data['pic3']."'>";

		if( ( $data['pic4'] != '') && file_exists( '../pic/consult/'.$data['pic4'] ) )
		$pic4 = "<img src='../pic/consult/".$data['pic4']."'>";

		if( ( $data['pic5'] != '') && file_exists( '../pic/consult/'.$data['pic5'] ) )
		$pic5 = "<img src='../pic/consult/".$data['pic5']."'>";

		$str_link = "";
		for($i=1;$i<=5;$i++){
			$url = $data["url".$i];
			$pic = $data["pic".$i];
			if(strlen($url)>0){
				$str_link.='<li class="link_w_pic"><a href="'.$url.'" target="_blank"><img src="pic/consult/'.$pic.'" alt=""></a></li>';
			}
		}
	}

	$dataary = array();
	$dataary = getConsultData(0,$conn);
	$str_dataary = json_encode($dataary);

	$tmpary = array();
	$pathary = getConsultPath($id,$conn,$tmpary);
	$str_pathary = json_encode($pathary);
	$str_path = "";
	foreach ($pathary as $key => $value) {
		if(strlen($str_path)<=0){
			$nowtitle = " - ".$value[1];
			$str_path = '<li>/</li><li>'.$value[1].'</li>'.$str_path;
		}else{
			$str_path = '<li>/</li><li><a href="online?id='.$value[0].'#cin">'.$value[1].'</a></li>'.$str_path;
		}
	}
	// echo json_encode($dataary);
?>
<!DOCTYPE html>
<html>
	<head>
		<?php require_once('i_meta.php'); ?>
		<title>線上諮詢</title>
	</head>
	<body >
		<?php require_once('i_header.php'); ?>
		<section>
			<div class="page_banner_pic" style="background-image:url(images/banner_02.png)" ;="">
				<div class="page_title">
					<div class="banner_title">線上諮詢</div>
					<div class="page_p">輕鬆提問，讓小C幫您解決問題</div>
				</div>
			</div>
			<div class="container all_wrapptop">
				<div class="bread_crumb">
					<ul>
						<li><a href="index">首頁</a></li>
						<li>/</li>
						<li class="bread_active"><a href="online">線上諮詢</a></li>
						<?=$str_path?>
					</ul>
				</div>
			</div>
		</section>
		<section>
			<div class="container">
				<div class="info_title"><?=$data["title"];?></div>
				<div class="line"></div>
				<div class="row onlinecontent">
					<div class="col-12 col-md-12 col-lg-12">
						<?=$text?>
					</div>
				</div>
				<br><br>
				<?php
					if(strlen($str_link)>0){
				?>
				<div class="online_name">相關連結</div>
				<?php
					}
				?>
				<div class="link_other">
					<ul>
						<?=$str_link?>
					</ul>
				</div>
				<div class="qekc_font">
					<div class="yes_btn clean">
						<div class="uij">上述資訊是否有幫助?</div>
						<div class="kekeke adke_active">是</div>
						<div class="kekeke">否</div>
					</div>
				</div>
				<ul class="prev_btn onlinepage">
					<a href="online?id=<?=$parent?>#cin">
						<li>< Prev</li>
					</a>
				</ul>
			</div>
		</section>
		<?php require_once('i_bottom.php'); ?>
	</body>
</html>
