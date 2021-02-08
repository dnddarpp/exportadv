<?php

	require_once("include.php");

	$typename = Array("東協10+6","美洲","亞洲","非洲","歐洲","中東","其他");

	//每頁顯示筆數

	$per = 20;
	$curpage = $conn->real_escape_string($_GET["page"]);

	$sql = "SELECT * FROM `tariff` where 1=1 ORDER BY `type`, `sort` desc, `id` DESC ";
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
	</head>
	<body>
		<?php require_once('i_header.php'); ?>
		<aside>
			<div class="side_wrapper">
				<?php require_once('i_menu.php'); ?>
				<div class="sidebar">
					<div class="right_continer">
						<div class="adsright_title">外連資源</div>
						<!-- <div class="icon_dk">
							<ul>
								<li><i class="mdi mdi-view-headline"></i></li>
								<li><i class="mdi mdi-view-list"></i></li>
							</ul>
						</div> -->
						<div class="news_table">
							<table width="100%" border="0">
								<tr>
									<td class="tab_gray" width="5%">編輯
									<!-- <td class="tab_gray" width="5%">顯示 -->
									<!-- <td class="tab_gray" width="5%">刪除 -->
									<td class="tab_gray" width="10%">類別
									<td class="tab_gray">標題
									<td class="tab_gray" width="5%">顯示
									<td class="tab_gray" width="10%">最後更新日期
								<tr style='border-bottom:1px solid #f2f2f2'>
									<td><a href="tariffedit?type=new&typeid=<?=$type?>"><i class="mdi mdi-plus-box"></i></a>
									<td>新增
									<!-- <td> -->
									<td>
									<td>
								<?php
									while($data = mysqli_fetch_assoc($result)) {
										$display = "Y";
										if($data["display"]=="0"){
											$display = "N";
										}
										$type = $typename[$data["type"]-1];
										$last = new DateTime($data["Last_time"]);
										$update = $last->format('Y-m-d');
								?>
								<tr>
									<td><a href="tariffedit?type=edit&id=<?=$data["id"]?>"><i class="mdi mdi-file-document-edit"></i></a>
									<!-- <td><a href=news_more.do data-method=post data-param='{"id":118,"act":"display"}'><i class="mdi mdi-eye"></i></a> -->
									<!-- <td><a href=news_more.do data-method=post data-param='{"id":118,"act":"delete"}' data-confirm=確定要刪除嗎? data-done=reload><i class="mdi mdi-delete"></i></a> -->
									<td><?=$type?></td>
									<td><?=$data["title"]?></td>
									<td><?=$display?></td>
									<td><?=$update?></td>
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
