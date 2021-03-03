<?php


	require_once("include.php");

	$typename = Array("最新消息","產業新聞");
	$type = $conn->real_escape_string($_GET["type"]);
	if(!$type){
		$type=1;
	}

	//每頁顯示筆數

	$per = 20;
	$curpage = $conn->real_escape_string($_GET["page"]);

	$sql = "SELECT * FROM news where display=1 ORDER BY `Public_date` DESC, `sort` DESC, `id` DESC ";
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
		<title>最新消息</title>
		<script>
			var type = "<?=$type?>"
			$( document ).ready(function(){
					setShowType(type)
					$(".country li").click(function(){
						$(".country li").removeClass("active")
						$(this).addClass("active")
						type = $(this).data("id")
						setShowType(type)
					})
			})
			function setShowType(_type){
				$(".news_list").hide()
				$('.news_list[data-type="'+_type+'"]').show()
			}
		</script>
	</head>
	<body >
		<?php require_once('i_header.php'); ?>
		<section>
			<div class="page_banner_pic" style="background-image:url(images/a.png)">
				<div class="page_title">
					<div class="banner_title">最新消息</div>
					<div class="page_p">最新消息及產業新聞</div>
				</div>
			</div>
			<div class="container all_wrapptop">
				<div class="bread_crumb">
					<ul>
						<li><a href="index">首頁</a></li>
						<li>/</li>
						<li class="bread_active">最新消息</li>
					</ul>
				</div>
			</div>
		</section>
		<section>
			<div class="container">
				<div class="info_title">最新消息</div>

				<div class="line"></div>
				<div class="info_btn">
					<ul class="country">
						<li class="active" data-id="1">最新消息</li>
						<li data-id="2">產業新聞</li>
					</ul>
				</div>
				<?php
					while($data = mysqli_fetch_assoc($result)) {
						$type = $typename[$data["type"]-1];
						$date =  explode(" ", $data["date"])[0];
						$public_date =  explode(" ", $data["Public_Date"])[0];
						$link = $data["url"];
						$target = 'target="_blank"';
						if(strlen($link)<=0){
							$link ="news_more?id=".$data["id"];
							$target="";
						}

				?>
				<div class="news_list" data-type="<?=$data["type"]?>">
					<div class="footer_table">
						<a href="<?=$link?>" <?=$target?>>
							<div class="row_table">
								<div class="cell_x2">
									<h2 class="nw_ft"><?=$data["title"]?></h2>
									<p class="nw_date"><?=$public_date." ".$type?></p>
									<ul class="nw_more">
										<li>
											<div class="nw_line"></div>
										</li>
										<li>了解更多</li>
										<li>
											<div class="nwpc"><img src="images/nw.svg" alt=""></div>
										</li>
									</ul>
								</div>
								<div class="cell_x2">
									<div class="news_ppc" data-aos="flip-left">
										<img src="pic/news/<?=$data["pic"]?>" alt="">
									</div>
								</div>
							</div>
						</a>
					</div>
				</div>
				<?php
				}
				?>

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
