<?php

	require_once("include.php");


	//每頁顯示筆數

	$per = 20;
	$curpage = $conn->real_escape_string($_GET["page"]);
	$id=$conn->real_escape_string($_GET["id"]);

	$sql = "SELECT * FROM event where display=1 ";
	if($id){
			$sql .="and id=".$id." ";
	}
	$sql .="ORDER BY  `sort` desc , `id` DESC ";
	$result = qury_sel($sql, $conn);

	$total = $result->num_rows;
	$pages = ceil($total/$per);

	if(!$curpage){
		$curpage=1;
	}
	$offset = ($curpage-1)*$per;
	$sql .= "Limit $per OFFSET $offset";
	$result = qury_sel($sql, $conn);
	$dataary = [];
	while($data = mysqli_fetch_assoc($result)) {
		$dataary[] = $data;
	}

?>
<!DOCTYPE html>
<html>
	<head>
		<?php require_once('i_meta.php'); ?>
		<title>活動照片</title>
		<script>
		$( document ).ready(function(){
			$("#picselect").change(function(){
				var val = $(this).val()
				location.href="picture_more?id="+val
			})
		})
		</script>
	</head>
	<body >
		<?php require_once('i_header.php'); ?>
		<section>
			<div class="page_banner_pic" style="background-image:url(images/banner_02.png)" ;="">
				<div class="page_title">
					<div class="banner_title">活動照片</div>
					<div class="page_p">精彩活動照片</div>
				</div>
			</div>
			<div class="container all_wrapptop">
				<div class="bread_crumb">
					<ul>
						<li><a href="index">首頁</a></li>
						<li>/</li>
						<li class="bread_active">活動照片</li>
					</ul>
				</div>
			</div>
		</section>
		<section>
			<div class="container">
				<div class="info_title">活動照片</div>
				<!-- <div class="picture_searchbar">
					<div class="search_picbox">
						<div class="search_iconL"><img src="images/search_02.svg" alt=""></div>
						<div class="search_input"><input name="" type="text"  placeholder="搜尋"/></div>
					</div>
				</div> -->
				<div class="picture_searchbar">
					<div class="search_picbox">
						<select name="" id="picselect">
							<option value="">=====請選擇=====</option>
							<?php
								foreach ($dataary as $key => $value) {
							?>
							<option data-id="<?=$value["id"]?>" value="<?=$value["id"]?>"><?=$value["title"]?></option>
							<?php
								}
							?>
						</select>
					</div>
				</div>
				<div class="line"></div>
				<div class="row picture_wrap">
					<?php
						foreach ($dataary as $key => $value) {
							$type = $typename[$value["type"]-1];
							$date =  explode(" ", $value["date"])[0];
							$public_date =  explode(" ", $value["Public_Date"])[0];
							$str_piclist = $value["pic"];
							$picary = json_decode($str_piclist);
							$img = array_column($picary[0], 'img');
							foreach ($picary[0] as $key2 => $value2) {
								if($key2=="img"){
									$img =$value2;
								}
								if($key2=="type"){
									$type =$value2;
								}
							}
							$pic = $img.".".$type;


					?>
					<div class="col-12 col-md-6 col-lg-6" data-aos="flip-left">
						<a href="picture_more?id=<?=$value["id"]?>">
							<div class="picutre_bg">
								<div class="picture_top_Bg" style="background-image:url(pic/album/<?=$pic?>)"></div>
								<div class="picmu_font">
									<div class="picture_name"><?=$value["title"]?></div>
									<p></p>
								</div>
							</div>
						</a>
					</div>
				<?php } ?>
				</div>
				<!-- <ul class="prev_btn onlinepage">
					<a href="#">
						<li>< Prev</li>
					</a>
					<a href="#">
						<li class="actvie">1</li>
					</a>
					<a href="#">
						<li>2</li>
					</a>
					<a href="#">
						<li>3</li>
					</a>
					<a href="#">
						<li>4</li>
					</a>
					<a href="#">
						<li>Next ></li>
					</a>
				</ul> -->
			</div>
		</section>
    <?php require_once('i_bottom.php'); ?>
	</body>
</html>
