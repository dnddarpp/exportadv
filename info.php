<?php

	require_once("include.php");

		$typename = Array("東協10+6","美洲","亞洲","非洲","歐洲","中東","其他");
	$type = $conn->real_escape_string($_GET["type"]);
	if(!$type){
		$type=1;
	}

	//每頁顯示筆數

	$per = 20;
	$curpage = $conn->real_escape_string($_GET["page"]);

	$sql = "SELECT * FROM tariff where display=1 ORDER BY `type`, `sort` , `id` DESC ";
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
		<title>各國關稅</title>
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
				$(".national").hide()
				$('.national[data-type="'+_type+'"]').show()
			}
		</script>
	</head>
	<body >
		<?php require_once('i_header.php'); ?>
		<section>
			<div class="page_banner_pic" style="background-image:url(images/banner_02.png)" ;="">
				<div class="page_title">
					<div class="banner_title">各國關稅</div>
					<div class="page_p">快速找尋各國的關稅</div>
				</div>
			</div>
			<div class="container all_wrapptop">
				<div class="bread_crumb">
					<ul>
						<li><a href="index">首頁</a></li>
						<li>/</li>
						<li class="bread_active">各國關稅</li>
					</ul>
				</div>
			</div>
		</section>
		<section>
			<div class="container ">
				<div class="info_title">各國關稅</div>

				<div class="line"></div>
				<!-- <div class="info_btn">
					<ul class="country">
						<li class="active" data-id="1">東協10+6</li>
						<li data-id="2">美洲</li>
						<li data-id="3">亞洲</li>
						<li data-id="4">非洲</li>
						<li data-id="5">歐洲</li>
						<li data-id="6">中東</li>
						<li data-id="7">其他</li>
					</ul>
				</div> -->
				<div class="fe_tittle"><a href="http://db2.wtocenter.org.tw/tariff" target="_blank">一、中華經濟研究院(WTO及RTA中心)網站關稅查詢系統 </a></div>
				<div class="fe_font">
                    WTO及RTA中心建製之「主要國家關稅查詢系統」，與WTO更新同步，該網站可依下列兩種方式查詢各國關稅:
                  </div>
				  <ul class="free_ul">
                  <li>依稅號查詢: <a href="http://db2.wtocenter.org.tw/tariff/Search_byHSCode.aspx" target="_blank"> http://db2.wtocenter.org.tw/tariff/Search_byHSCode.aspx </a></li>
                  <li>輸入貨名查詢:<a href="http://db2.wtocenter.org.tw/tariff/search_byProducts.aspx" target="_blank">http://db2.wtocenter.org.tw/tariff/search_byProducts.aspx</a>  </li>
               	</ul>

				<div class="fe_tittle"><a href="https://itrade.taiwantrade.com/" target="_blank">二、iTrade (全球貿易大數據平台) </a></div>
				<div class="fe_font">
                    經濟部國際貿易局為協助業者拓銷海外市場，委託外貿協會建置之「itrade全球貿易大數據平台」，提供線上即時的出口情勢分析、跨國關稅比較、篩選潛力市場等大數據統計資訊服務，歡迎廠商多加運用。該網站綜整各國關稅網站，提供以下兩項查詢功能:
                  </div>
				  <ul class="free_ul">
					 <li>單一出口國關稅查詢</li>
					 <li>多國關稅比較</li>
				  </ul>

				  <div class="fe_font">
                      ※	如需了解外國進口關稅更多資訊，請參考本網站→<a href="https://exportadv.chun-mu.com/online_last2?id=9" target="_blank"> 「線上諮詢-外國進口關稅」。</a>
                    </div>

				<div class="country_name"></div>
				<!-- <p class="margin_bm">發布日期: 2020/09/28</p> -->
				<!-- <div class="row">
					<?php
						while($data = mysqli_fetch_assoc($result)) {
							$type = $typename[$data["type"]-1];
							$date =  explode(" ", $data["date"])[0];
							$public_date =  explode(" ", $data["Public_Date"])[0];

					?>
					<div class="national col-4 col-md-2 col-lg-2" data-type="<?=$data["type"]?>">
						<a href="<?=$data["url"]?>" target="_blank">
							<div class="cou_pic"><img src="pic/tariff/<?=$data["pic"]?>" alt=""></div>
							<div class="cou_font"><?=$data["title"]?></div>
						</a>
					</div>
					<?php
						}
					?>

				</div> -->
			</div>
		</section>
    <?php require_once('i_bottom.php'); ?>
	</body>
</html>
