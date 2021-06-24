<?php
  require_once('include.php');

  $id = $conn->real_escape_string($_GET["id"]);
	$sql = "select *  from `news` where 1=1 and id = $id ";
	$pjdata = qury_sel($sql, $conn);
	$data = mysqli_fetch_assoc($pjdata);
	$typename = Array("最新消息","顧問專欄");
	$type = $typename[$data["type"]-1];
	$date = explode(" ", $data["Public_Date"])[0];
	$last = new DateTime($data["Last_time"]);
	$update = $last->format('Y-m-d');
	//$text = str_ireplace(['\\\\r', '\\\\n'], "", $data["content"]);
	$text = $data["content"];

  $meta_title=$data["MetaTitle"];
  $meta_description=$data["MetaDesc"];
  $meta_keywords = $data["MetaKeywords"];

?>
<!DOCTYPE html>
<html>
	<head>
		<?php require_once('i_meta.php'); ?>
		<title>最新消息 - <?=$data["title"]?></title>
    <script>
    $(document).ready(function() {
      var ww = $(window).width()
        $(".onlinecontent img").each(function(){
          $(this).css("text-align","center")
          var pw = $(this).width()
          if(pw>ww){
            $(this).css("width","100%")
            $(this).css("height","auto")
          }
        })
        $( window ).resize(function() {
          var ww = $(window).width()
          $(".onlinecontent img").each(function(){
            var pw = $(this).width()
            if(pw>ww){
              $(this).css("width","100%")
              $(this).css("height","auto")
            }
          })
        })
    })
    </script>
	</head>
	<body >
		<?php require_once('i_header.php'); ?>
		<section>
			<div class="page_banner_pic" style="background-image:url(images/a.png)" ;="">
				<div class="page_title">
					<div class="banner_title">最新消息</div>
					<div class="page_p">最新消息及顧問專欄</div>
				</div>
			</div>
			<div class="container all_wrapptop">
				<div class="bread_crumb">
					<ul>
						<li><a href="index">首頁</a></li>
						<li>/</li>
						<li><a href="news"><?=$type?></a></li>
						<li>/</li>
						<li class="bread_active"><?=$data["title"]?></li>
					</ul>
				</div>
			</div>
		</section>
		<section>
			<div class="container">
				<div class="nwes_title">
					<?=$data["title"]?>
				</div>
				<ul class="newspushtime">
					<li>發布日期：<?=$date?></li>
					<li> 更新日期：<?=$update?></li>
				</ul>
				<div class="line"></div>
				<div class="maincontent onlinecontent">
					<?=$text?>
				</div>
				<div class="line"></div>
				<!-- <div class="row prv">
					<div class="col-6 col-md-6 col-lg-6">
						<a href="#">
							<div class="ns_prev">
								<div class="prev_ic"><img src="images/page1.svg" alt=""></div>
							</div>
							<div class="ns_prev2">
								<ul>
									<li class="pr_L">上一則新聞</li>
									<li class="newspoint">2019年頒獎典禮:透過世界級的舞台 讓國際社會見證台灣永續力</li>
								</ul>
							</div>
						</a>
					</div>
					<div class="col-6 col-md-6 col-lg-6">
						<a href="#">
							<div class="ns_prev2 ">
								<ul>
									<li class="pr_R">下一則新聞</li>
									<li class="newspoint">2019年頒獎典禮:透過世界級的舞台 讓國際社會見證台灣永續力</li>
								</ul>
							</div>
							<div class="ns_prev">
								<div class="prev_ic"><img src="images/page2.svg" alt=""></div>
							</div>
						</a>
					</div>
				</div> -->
			</div>
		</section>
    <?php require_once('i_bottom.php'); ?>
	</body>
</html>
