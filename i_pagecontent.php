<section>
   <div class="page_banner_pic" style="background-image:url(<?=$banner?>)">
      <div class="page_title">
         <div class="banner_title"><?=$data["title"]?></div>
         <div class="page_p"><?=$data["subtitle"]?></div>
      </div>
   </div>
   <div class="container all_wrapptop">
      <div class="bread_crumb">
         <ul>
            <li><a href="index">首頁</a></li>
            <li>/</li>
            <li class="bread_active"><?=$data["title"]?></li>
         </ul>
      </div>
   </div>
</section>
<section>
   <div class="container">
      <div class="info_title"><?=$data["title"]?></div>
      <div class="line"></div>
      <div class="pagecontent">
        <?=$data["content"]?>
      </div>
   </div>
</section>
