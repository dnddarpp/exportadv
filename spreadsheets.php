<?php

	require_once("include.php");


	//每頁顯示筆數

	$per = 100;

	$sql_cate = "SELECT * FROM link_cate where display=1 ";
	$sql_cate .= " ORDER BY  `sort` desc , `id` DESC ";
	// echo $sql;
	$result_cate = qury_sel($sql_cate, $conn);
?>
<!DOCTYPE html>
<html>
	<head>
		<?php require_once('i_meta.php'); ?>
		<title>政府輔導資源</title>
	</head>
	<body >
		<?php require_once('i_header.php'); ?>
		<section>
			<div class="page_banner_pic" style="background-image:url(images/a.png)" ;="">
				<div class="page_title">
					<div class="banner_title">政府輔導及各項外銷資源</div>
					<!-- <div class="page_p"></div> -->
				</div>
			</div>
			<div class="container all_wrapptop">
				<div class="bread_crumb">
					<ul>
						<li><a href="index">首頁</a></li>
						<li>/</li>
						<li class="bread_active">政府輔導及各項外銷資源</li>
					</ul>
				</div>
			</div>
		</section>
		<section>
			<div class="container">
				<div class="info_title">政府輔導及各項外銷資源</div>
				<div class="line"></div>
				<div class="row">
					<?php
						while($catedata = mysqli_fetch_assoc($result_cate)) {
							$catename = $catedata["catename"];
							$cateid = $catedata["id"];
							$sql_link = "SELECT * FROM link where display=1 and type=".$cateid;
							$sql_link .= " ORDER BY  `sort` desc , `id` DESC ";
							// echo $sql;
							$result_link = qury_sel($sql_link, $conn);
					?>
					<div class="col-12 col-md-6 col-lg-3">
						<div class="spread_bg">
							<div class="spr_top_Bg">
								<div class="bu_icon"><img src="images/spr<?=$cateid?>.svg" alt=""></div>
								<div class="bu_font"><?=$catename?></div>
							</div>
							<div class="spr_font">
								<?php
								while($linkdata = mysqli_fetch_assoc($result_link)) {
								 ?>

									<a href="<?=$linkdata["url"]?>" target="_blank">
										<div class="bm_line clean">
											<div class="spr_L"><?=$linkdata["title"]?></div>
											<div class="spr_R">></div>
										</div>
									</a>

								<?php
								}
								?>
							</div>
						</div>
					</div>
					<?php
					}
					 ?>
				</div>
			</div>
		</section>
    <?php require_once('i_bottom.php'); ?>
	</body>
</html>
