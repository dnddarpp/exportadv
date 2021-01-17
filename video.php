<?php

	require_once("include.php");


	//每頁顯示筆數

	$per = 20;
	$curpage = $conn->real_escape_string($_GET["page"]);

	$sql = "SELECT * FROM media where display=1 ORDER BY  `sort` , `id` DESC ";
	$result = qury_sel($sql, $conn);

	$total = $result->num_rows;
	$pages = ceil($total/$per);

	if(!$curpage){
		$curpage=1;
	}
	$offset = ($curpage-1)*$per;
	$sql .= "Limit $per OFFSET $offset";
	$result = qury_sel($sql, $conn);
?>
<!DOCTYPE html>
<html>
	<head>
		<?php require_once('i_meta.php'); ?>
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
		<script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
		<title>影音專區</title>
	</head>
	<body >
		<?php require_once('i_header.php'); ?>
		<section>
			<div class="page_banner_pic" style="background-image:url(images/banner_02.png)" ;="">
				<div class="page_title">
					<div class="banner_title">影音專區</div>
					<div class="page_p">精采影片回顧</div>
				</div>
			</div>
			<div class="container all_wrapptop">
				<div class="bread_crumb">
					<ul>
						<li><a href="index">首頁</a></li>
						<li>/</li>
						<li class="bread_active">影音專區</li>
					</ul>
				</div>
			</div>
		</section>
		<section>
			<div class="container">
				<div class="info_title">影音專區</div>
				<!-- <div class="picture_searchbar">
					<div class="search_picbox">
					    <div class="search_iconL"><img src="images/search_02.svg" alt=""></div>
					    <div class="search_input"><input name="" type="text"  placeholder="搜尋"/></div>
					</div>
					</div> -->
				<div class="picture_searchbar">
					<div class="search_picbox">
						<select name="">
							<option>2020</option>
							<option>2019</option>
							<option>2018</option>
							<option>2017</option>
							<option>2016</option>
						</select>
					</div>
				</div>
				<div class="line"></div>
				<div class="row picture_wrap">
					<?php
						while($data = mysqli_fetch_assoc($result)) {
							$type = $typename[$data["type"]-1];
							$date =  explode(" ", $data["date"])[0];
							$public_date =  explode(" ", $data["Public_Date"])[0];

					?>
					<div class="col-12 col-md-6 col-lg-6">
						<a data-fancybox href="<?=$data["url"]?>">
							<div class="picutre_bg">
								<div class="picture_top_Bg" style="background-image:url(pic/media/<?=$data['pic']?>)">
									<div class="playicon"><img src="images/play.svg" alt=""></div>
								</div>
								<div class="picmu_font">
									<div class="picture_name"><?=$data["title"]?></div>
									<p>發布日期: <?=$public_date?></p>
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
