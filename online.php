<?php
	require_once("include.php");

	//每頁顯示筆數

	$parent = $conn->real_escape_string($_GET["id"]);
	$trackid = trackConsult($parent,$conn);
	// if(!isset($_GET["id"])){
	// 	$parent = 0;
	// }

	$sql = "";
	if(isset($_GET["id"]) && $parent>0){
		$sql = "SELECT a.*, b.title as parenttitle, b.parent as grandparentid FROM consult as a";
		$sql .= "  inner join consult as b on a.parent = b.id";
		$sql .= "  where 1=1 and a.display=1 and a.parent=".$parent." ";
	}else{
		$sql = "SELECT * FROM consult as a where 1=1 and display=1 and parent = 0 ";
		$parent = 0;
	}
	$sql .= "ORDER BY a.`sort`, a.`id`";
	// echo $sql;
	$result = qury_sel($sql, $conn);
	$ary = array();

	while($data = mysqli_fetch_assoc($result)) {
		$grandid = $data["grandparentid"];
		$ary[] = $data;
	}

	$tmpary = array();
	$pathary = getConsultPath($parent,$conn,$tmpary);
	$str_pathary = json_encode($pathary);
	$str_path = "";
	$nowtitle = "";

	foreach ($pathary as $key => $value) {
		if(strlen($str_path)<=0){
			$nowtitle = " - ".$value[1];
			$str_path = '<li>/</li><li>'.$value[1].'</li>'.$str_path;
		}else{
			$str_path = '<li>/</li><li><a href="online?id='.$value[0].'#cin">'.$value[1].'</a></li>'.$str_path;
		}
	}

	// $layer = 0;
	// $dataary = array();
	// $dataary[] = array("content"=> getConsultData($parent,$conn));
	// $str_dataary = json_encode($dataary);
?>
<!DOCTYPE html>
<html>
	<head>
		<?php require_once('i_meta.php'); ?>
		<title>線上諮詢</title>
		<script>
		var qaary = new Array()
		var tmpall = new Array()
		var listary = new Array()
		var parent = "<?=$parent?>"
			$(document).ready(function() {
				if(parent>0){
					$(".desc").hide()
				}
			})
		</script>
	</head>
	<body >
		<?php require_once('i_header.php'); ?>
		<section>
			<div class="page_banner_pic" style="background-image:url(images/banner_02.png)" ;="">
				<div class="page_title">
					<div class="banner_title">線上諮詢</div>
				</div>
			</div>
			<div class="container all_wrapptop" id="cin">
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
				<div class="info_title"><?=$nowtitle?></div>
				<p class="desc">歡迎 廠商先進 使用國際行銷諮詢中心線上諮詢，此服務將提供便捷的線上資訊。針對廠商在海外拓銷所遇到的問題，提供國際市場資訊、貿協資源轉介及數位貿易等服務。</p>
				<div class="line"></div>
				<div class="row online_wrap">
					<?php
						foreach ($ary as $item) {
							$end="";
							$linkid=$item["id"];
							if($item["endpage"]=="1"){
								$link="href='online_last2?id=".$linkid."'";
							}else{
								$link="href='online?id=".$linkid."#cin'";
							}
					?>
					<div class="qa_btn col-6 col-md-3 col-lg-3">
						<a <?=$link?>>
							<div class="onlie_qa"><?=$item["title"]?></div>
						</a>
					</div>
					<?php
						}
					?>
				</div>
				<?php if($parent>0){
				?>
				<ul class="prev_btn onlinepage">
					<a href="online?id=<?=$grandid?>#cin">
						<li>< 上一頁</li>
					</a>
				</ul>
				<?php
				} ?>

			</div>
		</section>
    <?php require_once('i_bottom.php'); ?>
	</body>
</html>
