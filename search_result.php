<!DOCTYPE html>
<html>
	<head>
		<?php require_once('i_meta.php'); ?>
		<title>搜尋結果</title>
	</head>
	<body >
		<?php require_once('i_header.php'); ?>
		<section>
			<div class="page_banner_pic" style="background-image:url(images/banner_02.png)" ;="">
				<div class="page_title">
					<div class="banner_title">搜尋結果</div>
					<!-- <div class="page_p"></div> -->
				</div>
			</div>
			<div class="container all_wrapptop">
				<div class="bread_crumb">
					<ul>
						<li><a href="index">首頁</a></li>
						<li>/</li>
						<li class="bread_active">搜尋結果</li>
					</ul>
				</div>
			</div>
		</section>
		<section>
      <div class="container">
        <div class="gcse-search"></div>
      </div>
		</section>
    <?php require_once('i_bottom.php'); ?>
	</body>
</html>
