<?php

	require_once("include.php");

	$typename = Array("最新消息","顧問專欄");
	$type = $conn->real_escape_string($_GET["type"]);
	$btime = $conn->real_escape_string($_GET["btime"]);
	$etime = $conn->real_escape_string($_GET["etime"]);
	$title = $conn->real_escape_string($_GET["title"]);
	$keyword = $conn->real_escape_string($_GET["keyword"]);
	if(!$type){
		$type=1;
	}

	//每頁顯示筆數

	$per = 100;
	$curpage = $conn->real_escape_string($_GET["page"]);

	$sql = "SELECT * FROM news where type = ".$type." ";
	if($btime){
		  $sql .= "and Public_Date >= '$btime' ";
	}
	if($btime){
		  $sql .= "and Public_Date <= '$etime' ";
	}
	if($title){
		  $sql .= "and title LIKE '%$title%' ";
	}
	if($keyword){
		  $sql .= "and (title LIKE '%$keyword%' or 	description LIKE '%$keyword%'  or content LIKE '%$keyword%') ";
	}
	$sql .= "ORDER BY `Public_date` DESC, `sort` DESC, `id` DESC ";
	// echo $sql;
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
		<title></title>
		<script>
		$( document ).ready(function(){
			$('.datepicker-input').datepicker({
		    dateFormat: 'yy-mm-dd',
		    monthNames: ['一月', '二月', '三月', '四月', '五月', '六月', '七月', '八月', '九月', '十月', '十一月', '十二月'],
		    dayNamesMin: '日一二三四五六',
		    yearSuffix: '年',
		    showMonthAfterYear: true,
		    changeMonth: true,
		    changeYear: true
		  });
			$(".clear").click(function(){
				$('input').val("")
				location.href="newslist.php"
			})
			$("#search_btn").click(function(){
				var btime = $("#btime").val()
				var etime = $("#etime").val()
				var title = $("#title").val()
				var keyword = $("#keyword").val()
				var url = "newslist.php?"
				if(btime.length>0){
					url+="btime="+btime+"&"
				}
				if(etime.length>0){
					url+="etime="+etime+"&"
				}
				if(title.length>0){
					url+="title="+title+"&"
				}
				if(keyword.length>0){
					url+="keyword="+keyword+"&"
				}
				location.href=url
			})

		})

		</script>
	</head>
	<body>
		<?php require_once('i_header.php'); ?>
		<aside>
			<div class="side_wrapper">
				<?php require_once('i_menu.php'); ?>
				<div class="sidebar">
					<div class="right_continer">
						<div class="adsright_title">最新消息-<?=$typename[$type-1]?></div>
							<div class="news_manag">
								<div class="manag_box">
									發布時間
									<input name="btime" id="btime" type="text" value="<?=$btime?>" class=datepicker-input style='border:1px solid #ccc' />  -
									<input name="etime" id="etime" type="text" value="<?=$etime?>" class=datepicker-input style='border:1px solid #ccc' />
								</div>
								<!-- <div class="manag_box">選擇分類
									<label><input name=class type=radio value=0 > 不限</label>
									<label><input name=class type=radio value=1 checked>最新消息</label>
									<label><input name=class type=radio value=2 >產業公告</label>
								</div> -->
								<div class="manag_box">
									搜尋標題
									<div class="man_bord"><input name="title" id="title" value="<?=$title?>" type="text" /></div>
								</div>
								<div class="manag_box">
									搜尋全文
									<div class="man_bord"><input name="title_content" id="keyword" value="<?=$keyword?>" type="text" placeholder='標題、描述或內容' /></div>
								</div>
								<br>
								<div class="btnwrap">
									<button class="delete_btn" id="search_btn">搜尋</button>
									<button class="delete_btn clear">清除</button>
								</div>
							</div>
						<div class="icon_dk">
							<ul>
								<li><i class="mdi mdi-view-headline"></i></li>
								<li><i class="mdi mdi-view-list"></i></li>
							</ul>
						</div>
						<div class="news_table">
							<table width="100%" border="0">
								<tr>
									<td class="tab_gray" width="5%">編輯
									<!-- <td class="tab_gray" width="5%">顯示 -->
									<!-- <td class="tab_gray" width="5%">刪除 -->
									<td class="tab_gray">標題
									<td class="tab_gray" width="10%">類別
									<td class="tab_gray" width="5%">顯示
									<td class="tab_gray" width="10%">發佈日期
									<td class="tab_gray" width="10%">最後更新日期
								<tr style='border-bottom:1px solid #f2f2f2'>
									<td><a href="newsedit?type=new&typeid=<?=$type?>"><i class="mdi mdi-plus-box"></i></a>
									<td>新增
									<!-- <td> -->
									<td>
									<td>
									<td>
									<td>
								<?php
									while($data = mysqli_fetch_assoc($result)) {
										$display = "Y";
										if($data["display"]=="0"){
											$display = "N";
										}
										$typenn = $typename[$data["type"]-1];
										$date =  explode(" ", $data["date"])[0];
										$public_date =  explode(" ", $data["Public_Date"])[0];
								?>
								<tr>
									<td><a href="newsedit?type=edit&id=<?=$data["id"]?>&typeid=<?=$type?>"><i class="mdi mdi-file-document-edit"></i></a>
									<!-- <td><a href=news_more.do data-method=post data-param='{"id":118,"act":"display"}'><i class="mdi mdi-eye"></i></a> -->
									<!-- <td><a href=news_more.do data-method=post data-param='{"id":118,"act":"delete"}' data-confirm=確定要刪除嗎? data-done=reload><i class="mdi mdi-delete"></i></a> -->
									<td><?=$data["title"]?></td>
									<td><?=$typenn?></td>
									<td><?=$display?></td>
									<td><?=$public_date?></td>
									<td><?=$data["Last_time"]?></td>
								<?php
								}
								?>


							</table>
						</div>
						<div class="page_box">
							<div class="dkeb page_active">1</div>
						</div>
					</div>
				</div>
			</div>
		</aside>
		<?php require_once('i_footer.php'); ?>
	</body>
</html>
