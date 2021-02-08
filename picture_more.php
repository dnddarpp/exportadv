<?php

	require_once("include.php");
	//每頁顯示筆數

	$per = 20;
	$curpage = $conn->real_escape_string($_GET["page"]);
	$id = $conn->real_escape_string($_GET["id"]);

	$sql = "SELECT * FROM event where 1=1 and id=$id and display=1 ORDER BY  `sort` desc , `id` DESC ";
	$result = qury_sel($sql, $conn);
	$data = mysqli_fetch_assoc($result);
	$str_piclist = $data["pic"];
	$picary = json_decode($str_piclist);
	$title = $data['title'];
	//
	// $total = $result->num_rows;
	// $pages = ceil($total/$per);
	//
	// if(!$curpage){
	// 	$curpage=1;
	// }
	// $offset = ($curpage-1)*$per;
	// $sql .= "Limit $per OFFSET $offset";
	// $result = qury_sel($sql, $conn);
?>
<!DOCTYPE html>
<html>
	<head>
		<?php require_once('i_meta.php'); ?>
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
		<script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
		<title>活動照片</title>
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
						<li><a href="picture">活動照片</a></li>
						<li>/</li>
						<li class="bread_active"><?=$title?></li>
					</ul>
				</div>
			</div>
		</section>
		<section>
			<div class="container">
				<div class="info_title"><?=$title?></div>
				<!-- <div class="picture_searchbar">
					<div class="search_picbox">
					    <div class="search_iconL"><img src="images/search_02.svg" alt=""></div>
					    <div class="search_input"><input name="" type="text"  placeholder="搜尋"/></div>
					</div>
					</div> -->
				<!-- <div class="picture_searchbar">
					<div class="search_picbox">
						<select name="">
							<option>2020</option>
							<option>2019</option>
							<option>2018</option>
							<option>2017</option>
							<option>2016</option>
						</select>
					</div>
				</div> -->
				<div class="line"></div>
				<!-- <div class="picsetting">
					<ul class="picselect">
						<li><input name="" type="checkbox" value="" /></li>
						<li>全選 ( 全不選 )</li>
						<li>共  9  筆資料</li>
					</ul>
					<div class="pic_select_btn">
						<div class="mls_picbox">
							<ul class="mlsselect">
								<li>
									<div class="mls"><img src="images/mls.svg" alt=""></div>
								</li>
								<li>加入下載清單</li>
							</ul>
						</div>
						<div class="mls_picbox">
							<ul class="mlsselect">
								<li>
									<div class="mls"><img src="images/mls2.svg" alt=""></div>
								</li>
								<li>查看下載清單</li>
							</ul>
						</div>
					</div>
				</div> -->
				<div class="row picture_wrap">
					<?php
					foreach ($picary as $key0 => $value0) {
						foreach ($value0 as $key => $value) {
							if($key=="img"){
								$img =$value;
							}
							if($key=="type"){
								$type =$value;
							}
							if($key=="title"){
								$title = $value;
							}
							$pic = $img.".".$type;
						}
					?>
					<div class="col-12 col-md-4 col-lg-4">
						<a href="pic/album/<?=$pic?>" data-fancybox="images" data-caption="<?=$title?>">
							<div class="picutre_bg">
								<div class="picture_top_Bg" style="background-image:url(pic/album/<?=$pic?>)"></div>
								<div class="picmu_font">
									<div class="picture_name"><?=$title?></div>
									<div class="picture_checkboxicon"><!-- <input name="" type="checkbox" value="" /> --></div>
								</div>
							</div>
						</a>
					</div>
					<?php
					}
					?>
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
