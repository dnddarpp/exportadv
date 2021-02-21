<?php

	require_once("include.php");

	//每頁顯示筆數

	$per = 20;
	$curpage = $conn->real_escape_string($_GET["page"]);

	$sql = "SELECT * FROM `page` where 1=1 ORDER BY `sort`, `id`";
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
						<div class="adsright_title">單元頁面</div>
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
									<td class="tab_gray">標題
									<td class="tab_gray" width="20%">最後更新日期
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
									<td><a href="pageedit?type=edit&id=<?=$data["id"]?>"><i class="mdi mdi-file-document-edit"></i></a>
									<td><?=$data["title"]?></td>
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
