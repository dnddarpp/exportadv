<?php

	require_once("include.php");

	$sql2 = "SELECT * FROM media_cate where display=1 ORDER BY  `sort` desc , `id` DESC ";
	$result2 = qury_sel($sql2, $conn);
?>
<!DOCTYPE html>
<html>
	<head>
		<?php require_once('i_meta.php'); ?>
		<title>網站地圖</title>
	</head>
	<body >
		<?php require_once('i_header.php'); ?>
		<section>
			<div class="page_banner_pic" style="background-image:url(images/a.png)" ;="">
				<div class="page_title">
					<div class="banner_title">網站地圖</div>
					<!-- <div class="page_p"></div> -->
				</div>
			</div>
			<div class="container all_wrapptop">
				<div class="bread_crumb">
					<ul>
						<li><a href="index">首頁</a></li>
						<li>/</li>
						<li class="bread_active">網站地圖</li>
					</ul>
				</div>
			</div>
		</section>
		<section>
			<div class="container">
				<div class="info_title">網站地圖</div>
				<div class="line"></div>
				<div class="row">
					<div class="sitmap_box col-12 col-md-6 col-lg-3">
						<a href="free"><div class="sitemap_tittle">免費諮詢</div></a>
					</div>
					<div class="sitmap_box col-12 col-md-6 col-lg-3">
						<a href="news"><div class="sitemap_tittle"> 最新消息</div></a>
						<ul class="sitemap_font">
							<a href="news" target="_blank"><li>最新消息</li></a>
							<a href="news" target="_blank"><li>顧問專欄</li></a>
						</ul>
                	</div>
					<div class="sitmap_box col-12 col-md-6 col-lg-3">
						<a href="info"><div class="sitemap_tittle">各國關稅</div></a>
                	</div>
					<div class="sitmap_box col-12 col-md-6 col-lg-3">
						<a href="picture"><div class="sitemap_tittle"> 活動照片</div></a>
                	</div>
					<div class="sitmap_box col-12 col-md-6 col-lg-3">
						<a href="video"><div class="sitemap_tittle"> 影音學習</div></a>
						<ul class="sitemap_font">
							<?php
								while($data = mysqli_fetch_assoc($result2)) {
									$type = $typename[$data["type"]-1];
									$date =  explode(" ", $data["date"])[0];
									$public_date =  explode(" ", $data["Public_Date"])[0];

							?>
							<a href="video" target="_blank"><li><?=$data["catename"]?></li></a>
							<?php
								}
							?>
						</ul>
                	</div>
					<div class="sitmap_box col-12 col-md-6 col-lg-3">
						<a href="#"><div class="sitemap_tittle">政府輔導資源</div></a>
						<ul class="sitemap_font">
							<a href="https://docs.google.com/spreadsheets/d/1XGr22ow9As7gy0yO5_1EDwelrQq1dUBas4gblXrA6jE/edit?usp=sharing" target="_blank"><li>政府輔導外銷資源</li></a>
							<a href="https://www.taitraesource.com/default.asp" target="_blank"><li>貿協全球資訊網</li></a>
							<a href="https://itrade.taiwantrade.com/" target="_blank"><li>iTrade全球貿易大數據</li></a>
							<a href="https://tsp.taiwantrade.com/exhibition.aspx?n=55&sms=9041" target="_blank"><li>海外參展決策輔助平台</li></a>
							<a href="https://gd.taiwantrade.com/?_ga=2.117056134.1083193909.1609090490-1411834324.1605109940" target="_blank"><li>數位基地</li></a>
							<a href="https://info.taiwantrade.com/promotion/event?_ga=2.117056134.1083193909.1609090490-1411834324.1605109940#menu=11608" target="_blank"><li>電商研討會</li></a>
							<a href="https://info.taiwantrade.com/promotion/event?_ga=2.117056134.1083193909.1609090490-1411834324.1605109940#menu=11608" target="_blank"><li>電商行銷課程</li></a>
							<a href="https://taiwantradeseo.blogspot.com/" target="_blank"><li>台灣經貿網SEO小學堂</li></a>
							<a href="https://info.taiwantrade.com/biznews/%E7%89%A9%E8%81%AF%E7%B6%B2%20IoT%20AIoT%20AI-search.html?match=2&_ga=2.117056134.1083193909.1609090490-1411834324.1605109940#menu=11607" target="_blank"><li>AIoT商情</li></a>
							<a href="https://www.exportadv.com.tw/zh-tw/menu/8CEB14A6DCF4E70CD0636733C6861689/info.html" target="_blank"><a href="#" target="_blank"><li>視訊會議軟體操作分享</li></a>
							<a href="http://mk.taiwantrade.com.tw/?_ga=2.117056134.1083193909.1609090490-1411834324.1605109940" target="_blank"><li>海外參展･拓展團</li></a>
							<a href="http://mk.taiwantrade.com.tw/?_ga=2.117056134.1083193909.1609090490-1411834324.1605109940" target="_blank"><li>海外商務中心</li></a>
							<a href="https://events.taiwantrade.com/imdplus" target="_blank"><li>國際市場開發專案Plus</li></a>
							<a href="https://www.taiwantradeshows.com.tw/zh_TW/index.html" target="_blank"><li>臺灣國際專業展</li></a>
							<a href="https://www.taiwanservices.com.tw/internet/zh/index.aspx" target="_blank"><li>推廣服務貿易</li></a>
							<a href="https://info.taiwantrade.com/?_ga=2.135399089.1083193909.1609090490-1411834324.1605109940" target="_blank"><li>臺灣經貿網</li></a>
							<a href="https://www.taiwanexcellence.org/tw" target="_blank"><li>台灣精品</li></a>
							<a href="https://thpc.taiwantrade.com/?_ga=2.135399089.1083193909.1609090490-1411834324.1605109940" target="_blank"><li>清真推廣中心</li></a>
						</ul>
                	</div>
					<div class="sitmap_box col-12 col-md-6 col-lg-3">
						<div class="sitemap_tittle"> 關於本站</div>
						<ul class="sitemap_font">
							<a href="Privacy" target="_blank"><li>服務條款和隱私權政策內容</li></a>
							<a href="disclaimer" target="_blank"><li>免責聲明</li></a>
							<a href="contact" target="_blank"><li>聯絡我們</li></a>
						</ul>
                	</div>
					<div class="sitmap_box col-12 col-md-6 col-lg-3">
						<a href="online"><div class="sitemap_tittle"> 線上諮詢</div></a>
                	</div>

				</div>
			</div>
		</section>
    <?php require_once('i_bottom.php'); ?>
	</body>
</html>
