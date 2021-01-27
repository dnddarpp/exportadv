<?php

	require_once("include.php");

	$typename = Array("最新消息","產業新聞");
	$type = $conn->real_escape_string($_GET["type"]);
	if(!$type){
		$type=1;
	}

	//每頁顯示筆數

	$per = 4;
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
      <title>國際行銷成長茁壯方案</title>
   </head>
   <body >
      <?php require_once('i_header.php'); ?>
      <section>
         <div class="banner_pic"><img src="images/sa.png" alt=""></div>
         <div class="container">
            <div class="row sev_wrap">
               <div class="col-4 col-md-4 col-lg-4" data-aos="flip-left">
                 <a href="https://events.taiwantrade.com/exportadv" target="_blank">
                  <div class="sev_bg">
                     <div class="sev_icon"><img src="images/icon01.svg" alt=""></div>
                     <div class="sev_font">國際行銷諮詢服務報名</div>
                  </div>
                  </a>
               </div>
               <div class="col-4 col-md-4 col-lg-4" data-aos="flip-left">
                 <a href="https://youtu.be/qsujZ_GB4Bs" target="_blank">
                  <div class="sev_bg">
                     <div class="sev_icon"><img src="images/icon02.svg" alt=""></div>
                     <div class="sev_font">國際行銷諮詢中心協助廠商海外拓銷</div>
                  </div>
                  </a>
               </div>
               <div class="col-4 col-md-4 col-lg-4" data-aos="flip-left">
                 <a href="picture">
                  <div class="sev_bg">
                     <div class="sev_icon"><img src="images/icon03.svg" alt=""></div>
                     <div class="sev_font">國際行銷諮詢歷史活動</div>
                  </div>
                  </a>
               </div>
            </div>
         </div>
      </section>
      <section>
         <div class="title_pic"><img src="images/title01.svg" alt="最新消息"></div>
         <div class="container" data-aos="fade-up">
            <div class="row">
              <?php
      					while($data = mysqli_fetch_assoc($result)) {
      						$type = $typename[$data["type"]-1];
      						$date =  explode(" ", $data["date"])[0];
      						$public_date =  explode(" ", $data["Public_Date"])[0];
                  $pdate = new DateTime($data["Public_Date"]);
                	$yy = $pdate->format('Y');
                  $mm = $pdate->format('M');
                  $dd = $pdate->format('d');

      				?>
               <div class="col-12 col-md-12 col-lg-6">
                 <a href="news_more.php?id=<?=$data["id"]?>">
                  <div class="news_bg">
                     <div class="news_L">
                        <div class="news_pic"style="background-image:url(pic/news/<?=$data["pic"]?>)" ; alt=""></div>
                     </div>
                     <div class="news_R">
                        <div class="date"><?=$dd?></div>
                        <div class="month"><span class="blue"><?=$mm?></span> <?=$yy?></div>
                        <h2><?=$data["title"]?></h2>
                        <p><?=$data["description"]?></p>
                     </div>
                  </div>
                </a>
               </div>
             <?php } ?>
            </div>
            <!-- <div class="dot">
               <ul>
                  <li><img src="images/d1.svg" alt=""></li>
                  <li><img src="images/d2.svg" alt=""></li>
                  <li><img src="images/d1.svg" alt=""></li>
                  <li><img src="images/d1.svg" alt=""></li>
               </ul>
            </div> -->
            <div class="title_pic"><img src="images/title02.svg" alt="政府輔導及各項外銷資源"></div>
            <div class="row res_wrap">
               <div class="col-6 col-md-3 col-lg-3 res_box" data-aos="flip-left">
                 <a href="spreadsheets">
                    <div class="res_pic"><img src="images/re1.svg" alt=""></div>
                    <div class="res_font">政府輔導外銷資源</div>
                  </a>
               </div>
               <div class="col-6 col-md-3 col-lg-3" data-aos="flip-left">
                 <a href="spreadsheets">
                  <div class="res_pic"><img src="images/re2.svg" alt=""></div>
                  <div class="res_font">海外市場資訊</div>
                  </a>
               </div>
               <div class="col-6 col-md-3 col-lg-3" data-aos="flip-left">
                 <a href="spreadsheets">
                  <div class="res_pic"><img src="images/re3.svg" alt=""></div>
                  <div class="res_font">海外拓銷工具</div>
                  </a>
               </div>
               <div class="col-6 col-md-3 col-lg-3" data-aos="flip-left">
                 <a href="spreadsheets">
                  <div class="res_pic"><img src="images/re4.svg" alt=""></div>
                  <div class="res_font">數位轉型專區</div>
                  </a>
               </div>
            </div>
         </div>
      </section>
      <?php require_once('i_bottom.php'); ?>
   </body>
</html>
